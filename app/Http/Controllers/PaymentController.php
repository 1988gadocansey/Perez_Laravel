<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models;
use Illuminate\Http\Request;

class PaymentController extends Controller {

	public $paymentproducts = array(
		"Bill Payment" => "Bill Payment",
		"eVoucher" => "eVoucher",
		"eTicket" => "eTicket");

	public function show_query() {

		\DB::listen(function ($sql, $binding, $timing) {
			print_r("<pre>");
			var_dump($sql);
			var_dump($binding);
		}
		);
	}
    
    public function new_receiptno(){
        $receiptno_query = Models\Receiptno::first();
		$receiptno_query->increment("receiptno", 1);
        $receiptno = str_pad($receiptno_query->receiptno, 12, "0", STR_PAD_LEFT);
		
        return $receiptno;
        
    }
    
    public function pad_receiptno($receiptno){
       return str_pad($receiptno, 12, "0", STR_PAD_LEFT);
       }

	public function add_params_to_product_search($request, $query) {
		if ($request->has('search')) {
			$search = $request["search"];
			//using the query closure and passing the $search to it allows laravel to create a subquery that encompasses the orWhere queries in one bracket
			$query->where(function ($query) use ($search) {
				$query->orWhere("payment_name", "like", "%$search%");
				$query->orWhere("account_no", "like", "%$search%");
				$query->orWhere("payment_info", "like", "%$search%");
				$query->orWhere("usage_instruction", "like", "%$search%");
			});

		}

		if ($request->has('deadline') && $request->has('submit')) {
			$query->where("deadline", $request["deadline"]);
		}

		return $query;
	}

	public function add_params_to_serials_transactions_search($request, $query) {

		if ($request->has('company')) {
			$query->where("company_id", $request["company"]);
		}

		if ($request->has('paymentproduct')) {
			$query->where("product_id", $request["paymentproduct"]);
		}

		if ($request->has('date1')) {
			$query->where("date_sold", ">=", $request["date1"]);
		}

		if ($request->has('date2')) {
			$query->where("date_sold", "<=", $request["date2"]);
		}

		return $query;
	}

	public function add_params_to_billpayment_transactions_search($request, $query) {

		if ($request->has('company')) {
			$query->where("company_id", $request["company"]);
		}

		if ($request->has('paymentproduct')) {
			$query->where("product_id", $request["paymentproduct"]);
		}

		if ($request->has('date1')) {
			$query->where("dates", ">=", $request["date1"]);
		}

		if ($request->has('date2')) {
			$query->where("dates", "<=", $request["date2"]);
		}

		return $query;
	}

    
    
    public function start_nullify(Request $request){
        if($request->isMethod("get")){
            return view("payments.start_nullify");
        }
        $receiptno = trim($request["receiptno"]);
        //check if payment has not been already nullified
        $check_transaction = Models\PaymentTransactions::where("receiptno",$receiptno)->where("status","nullified")->get();
        //if results are returned redirect back with error
        if(!$check_transaction->isEmpty()){
            return redirect("nullify")->withErrors("This payment has already been nullified");
        }
        
        return redirect("nullify/".$receiptno);
        
    }
    
    
    public function process_nullify(Request $request,$receiptno){
//        $this->show_query();
        
        $receiptno = $this->pad_receiptno($receiptno);
        if($request->isMethod("get")){
        //first check if payment with the receiptno exists 
        $check_transaction = Models\PaymentTransactions::where("receiptno",$receiptno)->get();
        //        dd($check_transaction);
        if($check_transaction->isEmpty()){
            return redirect("nullify")->withErrors("Invalid receipt no!There is no payment with this receipt no");
        }   
        
        $receiptno = trim($receiptno);
        // check if payment has not been already nullified or reversed
        $check_transaction = Models\PaymentTransactions::where("receiptno",$receiptno)
                ->where("status","NULLIFIED")->orWhere(function($query){
                    $query->where("status","LIKE","REV|%$receipno%");                    
                })->get();
        
//        dd($check_transaction);
        if(!$check_transaction->isEmpty()){
            return redirect("nullify")->withErrors("This payment has already been nullified");
        }        
      $payment_transaction= Models\PaymentTransactions::where("receiptno", $receiptno)
                     ->where("status","!=","nullified")
                    ->with(array("product_info", "company_info","bill_customer_info"=>
                        function($query){
       $query->join("payment_transactions","bill_customers.product_id","=","payment_transactions.product_id")->distinct()->take(1);
        }))->first();
        
//        dd($payment_transaction);   
            return view("payments.nullify_payment")->with("payment_transaction",$payment_transaction);
        }
        
        //if request is post then we assume the user has clicked on the nullification submit button
        $payment_transaction= Models\PaymentTransactions::where("receiptno", $receiptno)
                    ->with(array("product_info","company_info","bill_customer_info"=>function($query){
           $query->join("payment_transactions","bill_customers.product_id","=","payment_transactions.product_id");
        }))->first();
//        \DB::transaction
        $bill_customer = $payment_transaction->bill_customer_info[0] ;
        $balancebf = $bill_customer->amount;
        
        $amount_paying = (-1*($payment_transaction->amount));        
        $update =$bill_customer->decrement("amount", $amount_paying );        
        //refresh or reload information for the bill customer after the update
        $bill_customer->fresh();
        
        $balance = $balancebf-$amount_paying;
        $nullified_by = $request->session()->get("current_user.username")."|".$request->session()->get("current_user.name")."|".$request->session()->get("current_user.bank")."|".$request->session()->get("current_user.branch");
        
        $log = Models\PaymentTransactions::create(array(
			"receiptno" => $this->new_receiptno(),
			"company_id" => $bill_customer->company_id,
			"product_id" => $bill_customer->product_id,
			"product_type" => $payment_transaction->product_type,
			"client_id" => $payment_transaction->client_id,
			"amount" => $amount_paying,
			"balancebf" => $balancebf,
			"balance" => $balance,
			"dates" => \DB::raw("NOW()"),
			"status" => "REV|".$receiptno,
            "sold_by"=>$nullified_by
		));
        
        
        $up=Models\PaymentTransactions::where("receiptno",$receiptno)->update(array("status"=>"NULLIFIED"));
        
        if(!$log ){
            return redirect("nullify/".$receiptno)->withErrors("Payment with Receipt N<u>o</u> :<span style='font-weight:bold;font-size:18px;'> $receiptno </span>could not be nullified!");
        }
    
        return redirect("nullify")->with("success_messages",array("Payment with Receipt N<u>o</u> :<span style='font-weight:bold;font-size:18px;'> $receiptno </span>successfully nullified! "));
    }
    
    
    
	public function fetchbillcustomers(Request $request) {

		$bill_customers = \DB::table("bill_customers")->where("company_id",
			$request["company"])->where("product_id",
			$request["product"])
			->where(function ($query) use ($request) {
				$query->orWhere("indexno", "like",
					"%" . $request["search"] . "%")
					->orWhere("name", "like",
						"%" . $request["search"] . "%");
			})->select("indexno as id",
			\DB::raw("CONCAT(name,'(',indexno,')') as text"))->get();
		return response()->json($bill_customers);
	}

	public function showbillpayment(Request $request, $productid, $indexno) {
		$product = Models\PaymentProduct::where("id", $productid)->firstOrFail();
		$billcustomer = Models\BillCustomers::where("indexno", $indexno)->where("product_id",
			$productid)->where("company_id", $product->company_id)->firstOrFail();

		$receiptno_query = Models\Receiptno::first();
		$receiptno = str_pad($receiptno_query->receiptno, 12, "0", STR_PAD_LEFT);
		$receiptno_query->increment("receiptno", 1);

		// $request->session()->flash("receiptno",$receiptno);
		return view("payments.billPayment")->with("billcustomer", $billcustomer)->with("product",
			$product)->with("receiptno", $receiptno);
	}

	public function processbillpayment(Requests\BillPaymentRequest $request, $productid, $indexno) {
// dd($request);
		$amount_paying = $request["amount_paying"];
		$receiptno = $request["receiptno"];

		set_time_limit(36000);

		//transaction is used here so that any errror rolls back the whole process and prevents any inserts or updates
//        dd($request);
		\DB::beginTransaction();

		$billcustomer = Models\BillCustomers::where("indexno", $indexno)->where("product_id",
			$productid)->where("company_id", $request["company_id"])->firstOrFail();

		$product = Models\PaymentProduct::where("id", $productid)->firstOrFail();
        
        $cot = $product->cot;
		//amount remaining to be paid before billcustomer is updated
		$amount_remaining = $billcustomer->amount;
        $actual_amount_paying = $amount_paying-$cot;
		$balance = $amount_remaining -$actual_amount_paying;
        $sold_by =$request->session()->get("current_user.username")."|". $request->session()->get("current_user.name")."|".$request->session()->get("current_user.bank")."|".$request->session()->get("current_user.branch");
        
		$log = Models\PaymentTransactions::create(array(
			"receiptno" => $receiptno,
			"company_id" => $request["company_id"],
			"product_id" => $productid,
			"product_type" => $product->purpose,
			"client_id" => $billcustomer->indexno,
			"amount" => $actual_amount_paying,
			"balancebf" => $amount_remaining,
			"balance" => $balance,
			"dates" => \DB::raw("NOW()"),
			"status" => "COMPLETED",
			"cot"=>$cot,
            "sold_by"=>$sold_by
		));

		if (!$log) {
			\DB::rollBack();
			return back()->withInput()->withErrors("Error making payment!");
		}

		$payment = $billcustomer->update(array(
			"amount" => $balance,
			"lastpaid" => $log->dates));

		if (!$payment) {
			\DB::rollBack();
			return back()->withInput()->withErrors("Error making payment!");
		}

		\DB::commit();

		$sms = "Hello $billcustomer->name, You have Paid $product->currency $actual_amount_paying being payment for $product->payment_name Balance:$balance .Receipt No:$receiptno . Thank You";

		$url = url("printreceipt/".trim($receiptno));
		$print_window = "<script >window.open('$url','','location=1,status=1,menubar=yes,scrollbars=yes,resizable=yes,width=1000,height=500')</script>";

		$smscontroller = new SMSController;
		$smscontroller->send_sms($billcustomer->phone, $sms);

		$request->session()->flash("success_message",
			"Payment successfully made for $billcustomer->name (  $billcustomer->indexno )<br>Receipt N<u>o</u>  :  <span style='font-weight:bold!important; font-size: 18px!important;'>$receiptno</span><br/>Payment Type : $product->payment_purpose <br> Amount : $product->currency $actual_amount_paying<br/> Balance : $product->currency  $balance   $print_window");

		return redirect("/startpay");
	}

	public function printreceipt(Request $request, $receiptno) {

		// $this->show_query();

		$payment_transaction = Models\PaymentTransactions::where("receiptno",
			$receiptno)->with("product_info", "evoucher_info",
			"company_info", "eticket_info")->first();

		if (empty($payment_transaction)) {
			abort(434, "No payment transaction with this receipt <span class='uk-text-bold uk-text-large'>$receiptno</span>");
		}

		$payment_transaction->CONVERTED_AMOUNT = $this->convert($payment_transaction->amount);

		$view_to_print = "";
		$showbillpayment = false;

		$customer_info = null;

		if (strtolower($payment_transaction->product_type) ==
			"bill payment") {
			$showbillpayment = true;
			$view_to_print = "payments.billreceipt";
			$customer_info = Models\BillCustomers::where("indexno",
				$payment_transaction->client_id)->where("company_id",
				$payment_transaction->company_id)->where("product_id",
				$payment_transaction->product_id)->firstOrFail();
		}

//        dd($payment_transaction->evoucher_info);

		if (strtolower($payment_transaction->product_type) !=
			"bill payment") {
			$view_to_print = "payments.serialsreceipt";

			//check for the type of transaction whether evoucher or eticket and copy the necessary info from the relationship on $payment_transaction . Thus only a filled customer variable is sent to the view
			if (!$payment_transaction->evoucher_info->isEmpty()) {
				$customer_info = $payment_transaction->evoucher_info[0];
			} else {
				$customer_info = $payment_transaction->eticket_info[0];
			}
		}

		return view($view_to_print)->with("payment_transaction",
			$payment_transaction)->with("showbillpayment",
			$showbillpayment)->with("customer_info", $customer_info);
	}

	public function showserialspayment(Request $request, $productid) {
		$product = Models\PaymentProduct::where("id", $productid)->firstOrFail();
		$receiptno_query = Models\Receiptno::first();
		$receiptno = str_pad($receiptno_query->receiptno, 12, "0", STR_PAD_LEFT);
		$receiptno_query->increment("receiptno", 1);
		return view("payments.serialspayment")->with("product", $product)->with("receiptno",
			$receiptno);
	}

	public function processserialspayment(Requests\SerialsPaymentRequest $request,
		$productid) {

// $this->show_query();
		$receiptno = $request["receiptno"];
		$name = $request["name"];
		$phone = $request["phone"];
		// $address = $request["address"];
		$email = $request["email"];
		$serials_list = array(
			"evoucher" => Models\Evouchers::class,
			"eticket" => Models\Etickets::class);

		set_time_limit(36000);
//Allotey  before  you read this portion feel free to say "ah this boy fool oooo!! wey kind plenty useless code  this"
		//transaction is used here so that any errror rolls back the whole process and prevents any inserts or updates
		\DB::beginTransaction();

		$product = Models\PaymentProduct::where("id", $productid)->firstOrFail();

		//get the model from the array serials_list
		$serial_type = $serials_list[strtolower($product->purpose)];
		//find a single serial record from the database
		$serial = $serial_type::where("product_id", $productid)->where("company_id",
			$product->company_id)->where("status", "")->where("receiptno",
			"")->orderBy("id", "asc")->take(1)->firstOrFail();

        
        $sold_by = $request->session()->get("current_user.username")."|". $request->session()->get("current_user.name")."|".$request->session()->get("current_user.bank")."|".$request->session()->get("current_user.branch");
        
		//lock the table and update the serial above based on the condition of blank statius and blank receipt number. Hopefully this ensures that a race condition does not occur where a record may be  used twice or updated twice
		$update_voucher = $serial->lockForUpdate()->where("id", $serial->id)->where("status",
			"")->where("receiptno", "")->update(array(
			"status" => "SOLD",
			"receiptno" => $receiptno,
			"date_sold" => \DB::raw("NOW()"),
			"price" => $product->default_value,
			"name" => $name,
			"phone" => $phone,
			"email" => $email,
            "sold_by"=>$sold_by    
                ));
            

		if (!$update_voucher) {
			\DB::rollBack();
			return back()->withInput()->withErrors("Error making payment! ");
		}

		//refresh or reload the serial model after the update is successful
		$serial = $serial->fresh();

		$log = Models\PaymentTransactions::create(array(
			"receiptno" => $receiptno,
			"company_id" => $product->company_id,
			"product_id" => $product->id,
			"product_type" => $product->purpose,
			"client_id" => "",
			"amount" => $product->default_value,
			"balancebf" => 0.00,
			"balance" => 0.00,
			"dates" => $serial->date_sold,
			"status" => "COMPLETED",
            "sold_by"=>$serial->sold_by
		));

		if (!$log) {
			\DB::rollBack();
			return back()->withInput()->withErrors(	"Error making payment!");
		}

//finally we commit.
		//Allotey if you are reading this portion feel free to say "ah this boy fool oooo!! wey kind plenty useless code  this"
		\DB::commit();

		$sms = "Hello $serial->name, You have Paid $product->currency $serial->price being payment for $product->payment_name.Receipt No:$receiptno.PIN: $serial->pin.";
		if ($serial->serial) {
			$sms .= "Serial: $serial->serial";
		}
		$sms .= "Thank You";

		$url = url("printreceipt/".trim( $receiptno));
		$print_window = "<script >window.open('$url','','location=1,status=1,menubar=yes,scrollbars=yes,resizable=yes,width=1000,height=500')</script>";

		$smscontroller = new SMSController;
		$smscontroller->send_sms($serial->phone, $sms);

		$request->session()->flash("success_message",
			"Payment successfully made for $serial->name <br>Receipt N<u>o</u>  :  <span class='uk-text-bold uk-text-larg'>$receiptno</span><br/>Payment Type : $product->purpose ( $product->payment_name ) <br> Amount : $product->currency $serial->price<br/>   $print_window");

		return redirect("/startpay");
	}

	public function showpayform(Request $request) {

		// dd($request);
		$companies = Models\Company::lists("name", "code");
		$products = null;
		$show_fetch_bill_customer = false;

		if ($request->has("company")) {
			$products = Models\PaymentProduct::where("company_id",
				$request["company"])->where("deadline", ">=",
				date("Y-m-d"))->lists("payment_name", "id");
		}

		if ($request->has("product")) {
			$product = Models\PaymentProduct::where("id", $request["product"])->where("deadline",
				">=", date("Y-m-d"))->first();
			if (isset($product) &&
				(strtolower($product->purpose) ==
					"bill payment")) {
				$show_fetch_bill_customer = true;
			}
		}
//if the fields product, company and billcustomer have been filled, and the submit button has been pressed then redirect to the billpayment page
		if ($request->has("product") &&
			$request->has("company") &&
			$request->has("billcustomer") &&
			$request->has("submit")) {
			return redirect(url("billpayment/" . $request["product"] . "/" . $request["billcustomer"]));
		}
//if the request has product and company but show_fetch_bill_customer ==false, this means the product is not bill payment and therefore we redirect to the serialspayment url
		if ($request->has("product") &&
			$request->has("company") &&
			$show_fetch_bill_customer ==
			false) {
			return redirect(url("serialspayment/" . $request["product"]));
		}

		$request->flash();
		return view("payments.addpayment")->with("companies", $companies)->with("products",
			$products)->with("show_fetch_bill_customer",
			$show_fetch_bill_customer);
	}

	public function viewpayments(Request $request) {
		$paymentproduct = Models\PaymentProduct::lists("payment_name", "id");
		$purpose = Models\Purpose::lists("purpose", "purpose");
		$company = Models\Company::lists("code", "code");

		$paymenttransactions_query = Models\PaymentTransactions::query();

		if ($request->has("company")) {
			$paymenttransactions_query->where("company_id", $request["company"]);
		}

		if ($request->has("purpose")) {
			$paymenttransactions_query->where("product_type",
				$request["purpose"]);
		}

		if ($request->has("paymentproduct")) {
			$paymenttransactions_query->where("product_id",
				$request["paymentproduct"]);
		}

		if ($request->has("date1")) {
			$paymenttransactions_query->where("dates", ">=",
				$request["date1"]);
		}

		if ($request->has("date2")) {
			$paymenttransactions_query->where("dates", "<=",
				$request["date2"]);
		}

		$paymenttransactions = $paymenttransactions_query->with('company_info',
			'product_info', 'bill_customer_info',
			'ticket_customer_info', 'voucher_customer_info')->orderBy("dates",
			"desc")->paginate(10);

		$request->flashExcept("_token");
		return view("payments.paymenttransactions")->with("paymenttransactions",
			$paymenttransactions)->with("paymentproducts",
			$this->paymentproducts)
			->with("company", $company)->with("purpose", $purpose)->with("paymentproduct",
			$paymentproduct);
	}

	public function view_etickets_transactions(Request $request) {

		$paymenttransactions_query = Models\Etickets::where("status", "!=", "")->where("receiptno", "!=", "")->with("payment_transaction_info");

		$paymenttransactions_query = $this->add_params_to_serials_transactions_search($request, $paymenttransactions_query);

		$paymentproducts_query = Models\PaymentProduct::where("purpose", "eTicket")->get();

		$company = Models\Company::lists("name", "code");
		//using laravels collection functions
		$purpose = $paymentproducts_query->pluck("purpose", "purpose");
		$paymentproducts = $paymentproducts_query->pluck("payment_name", "id");

		$paymenttransactions = $paymenttransactions_query->orderBy("dates",
			"desc")->paginate(10);

		$request->flashExcept("_token");
		return view("payments.eticketstransactions")->with("paymenttransactions",
			$paymenttransactions)->with("paymentproducts", $paymentproducts)->with("purpose", $purpose)->with("company", $company);

	}

	public function view_evouchers_transactions(Request $request) {

		$paymenttransactions_query = Models\Evouchers::where("status", "!=", "")->where("receiptno", "!=", "")->with("payment_transaction_info");

		$paymenttransactions_query = $this->add_params_to_serials_transactions_search($request, $paymenttransactions_query);
		$paymentproducts_query = Models\PaymentProduct::where("purpose", "eVoucher")->get();

		$company = Models\Company::lists("name", "code");
		//using laravels collection functions
		$purpose = $paymentproducts_query->pluck("purpose", "purpose");
		$paymentproducts = $paymentproducts_query->pluck("payment_name", "id");

		$paymenttransactions = $paymenttransactions_query->orderBy("dates",
			"desc")->paginate(10);

		$request->flashExcept("_token");
		return view("payments.evoucherstransactions")->with("paymenttransactions", $paymenttransactions)->with("paymentproducts", $paymentproducts)->with("purpose", $purpose)->with("company", $company);
	}

	public function view_billpayment_transactions(Request $request) {
//  $this->show_query();
        $paymenttransactions_query = Models\PaymentTransactions::where(\DB::raw("lower(product_type)"), "bill payment")->with(array("product_info", "company_info",
            "bill_customer_info"=>function($query){
            $query->join("payment_transactions","bill_customers.product_id","=","payment_transactions.product_id");
        }));
        
		$paymenttransactions_query = $this->add_params_to_billpayment_transactions_search($request, $paymenttransactions_query);

//
		//		if ($request->has("company")) {
		//			$paymenttransactions_query->where("company_id", $request["company"]);
		//		}
		//
		//		if ($request->has("purpose")) {
		//			$paymenttransactions_query->where("product_type",
		//				$request["purpose"]);
		//		}
		//
		//		if ($request->has("paymentproduct")) {
		//			$paymenttransactions_query->where("product_id",
		//				$request["paymentproduct"]);
		//		}
		$paymentproducts_query = Models\PaymentProduct::where('purpose', "Bill Payment")->get();

		$company = Models\Company::lists("name", "code");
		//using laravels collection functions
//		$purpose = $paymentproducts_query->pluck("purpose", "purpose");
		$paymentproducts = $paymentproducts_query->pluck("payment_name", "id");

		$paymenttransactions = $paymenttransactions_query->orderBy("dates",
			"desc")->paginate(10);

		$request->flashExcept("_token");
//        dd($paymenttransactions);
		return view("payments.billpaymenttransactions")->with("paymenttransactions",
			$paymenttransactions)->with("paymentproducts", $paymentproducts)->with("company", $company);
	}

	public function convert_number($number) {

		if (($number < 0) || ($number > 999999999)) {
			return "$number";
		}

		$Gn = floor($number / 1000000); /* Millions (giga) */
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000); /* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100); /* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10); /* Tens (deca) */
		$n = $number % 10; /* Ones */

		$res = "";

		if ($Gn) {
			$res .= $this->convert_number($Gn) . " Million";
		}

		if ($kn) {
			$res .= (empty($res) ? "" : " ") .
			$this->convert_number($kn) . " Thousand";
		}

		if ($Hn) {
			$res .= (empty($res) ? "" : " ") .
			$this->convert_number($Hn) . " Hundred";
		}

		$ones = array(
			"",
			"One",
			"Two",
			"Three",
			"Four",
			"Five",
			"Six",
			"Seven",
			"Eight",
			"Nine",
			"Ten",
			"Eleven",
			"Twelve",
			"Thirteen",
			"Fourteen",
			"Fifteen",
			"Sixteen",
			"Seventeen",
			"Eighteen",
			"Nineteen");
		$tens = array(
			"",
			"",
			"Twenty",
			"Thirty",
			"Fourty",
			"Fifty",
			"Sixty",
			"Seventy",
			"Eighty",
			"Ninety");

		if ($Dn ||
			$n) {
			if (!empty($res)) {
				$res .= " and ";
			}

			if ($Dn <
				2) {
				$res .= $ones[$Dn *
					10 +
					$n];
			} else {
				$res .= $tens[$Dn];

				if ($n) {
					$res .= "-" . $ones[$n];
				}
			}
		}

		if (empty($res)) {
			$res = "zero";
		}

		return $res;

//$thea=explode(".",$res);
	}

	public function convert($amt) {
//$amt = "190120.09" ;

		$amt = number_format($amt, 2, '.', '');
		$thea = explode(".", $amt);

//echo $thea[0];

		$words = $this->convert_number($thea[0]) . " Ghana Cedis ";
		if ($thea[1] >
			0) {
			$words .= $this->convert_number($thea[1]) . " Pesewas";
		}

		return $words;
	}

}
