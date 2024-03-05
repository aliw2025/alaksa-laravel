<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Investor;
use App\Models\InvestorLeadger;
use App\Models\Account;
use App\Models\AccountType;
use App\Models\ChartOfAccount;
use App\Models\ExpenseHead;
use App\Models\GLeadger;
use App\Models\PaymentType;
use App\Models\TransactionStatus;

use App\Models\User;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        /********************** Leadger Entries  ****************************/
        // //1- cash
        $type = new AccountType();
        $type->name = "cash";
        $type->category = "Assets";
        $type->save();
        //2- equipment  
        $type = new AccountType();
        $type->name = "Equipment";
        $type->category = "Assets";
        $type->save();
        // //3- inventory
        $type = new AccountType();
        $type->name = "inventory";
        $type->category = "Assets";
        $type->save();
        // //4- bank
        $type = new AccountType();
        $type->name = "Bank";
        $type->category = "Assets";
        $type->save();
        // //5- account receivable
        $type = new AccountType();
        $type->name = "Account Receivable";
        $type->category = "Assets";
        $type->save();
        // //6- equity
        $type = new AccountType();
        $type->name = "equity";
        $type->category = "equity";
        $type->save();
        // //7- account payable
        $type = new AccountType();
        $type->name = "Account Payable";
        $type->category = "Liabilty";
        $type->save();
        // //8- expenses
        $type = new AccountType();
        $type->name = "Expenses";
        $type->category = "Expenses";
        $type->save();
        // //9-sale revenue
        $type = new AccountType();
        $type->name = "Sale Revenue";
        $type->category = "Revenue";
        $type->save();
        // //10-trade discount revenue
        $type = new AccountType();
        $type->name = "Trade Discount Revenue";
        $type->category = "Revenue";
        $type->save();

        $transaction_type = new TransactionStatus();
        $transaction_type->desc = "entry";
        $transaction_type->save();

        $transaction_type = new TransactionStatus();
        $transaction_type->desc = "cancelled";
        $transaction_type->save();

        $transaction_type = new TransactionStatus();
        $transaction_type->desc = "posted";
        $transaction_type->save();

        $transaction_type = new TransactionStatus();
        $transaction_type->desc = "returned";
        $transaction_type->save();


        // dd('sdsds');

        $payment_type = new PaymentType();
        $payment_type->name = "instalment";
        $payment_type->save();

        $payment_type = new PaymentType();
        $payment_type->name = "cash";
        $payment_type->save();



        // company investor has always type 1
        $investor = Investor::where('investor_type', '=', 1)->first();
        // if invesotor alreay exists skip creting
        if ($investor === null) {

            $investor = new Investor();
            $investor->investor_name = "Alpha digital";
            $investor->email = "support@alphaDigital.com";
            $investor->phone = "00000000";
            $investor->prefix = "AD";
            $investor->investor_type = 1;
            $investor->save();
            
            /********************** creating accounts ****************************/
            // 1- cash
            $investor_cash = $investor->charOfAccounts()->create([
                'account_name' => 'cash',
                'account_type' => 1,
                'opening_balance' => 0
            ]);
            // 2- equipment
            $investor_eq = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_equipment',
                'account_type' => 2,
                'opening_balance' => 0
            ]);
            // 3- inventory
            $investor_inv = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_inventory',
                'account_type' => 3,
                'opening_balance' => 0
            ]);
            // 4 - bank
            $investor_bnk = $investor->charOfAccounts()->create([
                'account_name' => 'bank',
                'account_type' => 4,
                'opening_balance' => 0
            ]);
            // 5- account receivable
            $investor_rcv = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_receivable',
                'account_type' => 5,
                'opening_balance' => 0
            ]);
            // 6- equity 
            $investor_eqt = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_equity',
                'account_type' => 6,
                'opening_balance' => -0
            ]);
            // 7- payable
            $investor_pyb = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_payable',
                'account_type'      => 7,
                'opening_balance' => 0
            ]);

            //8- expense
            $investor_pyb = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_expense',
                'account_type' => 8,
                'opening_balance' => 0
            ]);
            // 9 - unrealized profit
            $investor_un_pft = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_un_profit',
                'account_type' => 9,
                'opening_balance' => 0
            ]);
            // 10 - trade discount profit
            $investor_td_pft = $investor->charOfAccounts()->create([
                'account_name' => $investor->prefix . '_trade_profit',
                'account_type' => 10,
                'opening_balance' => 0
            ]);


            
            
            /********************** Leadger Entries  ****************************/

            // adding entries to leadger of opening bakance of cash
            $investor->leadgerEntries()->create([
                'account_id' => $investor_cash->id,
                'investor_id'=>$investor->id,
                'value' => 0,
                'date' => $investor->created_at
            ]);
            // adding entries to leadger of opening bakance of equity
            $investor->leadgerEntries()->create([
                'account_id' => $investor_eqt->id,
                'investor_id'=>$investor->id,
                'value' => 0,
                'date' => $investor->created_at

            ]);
             // adding entries to leadger of opening bakance of bank
            $investor->leadgerEntries()->create([
                'account_id' => $investor_bnk->id,
                'investor_id'=>$investor->id,
                'value' => 0,
                'date' => $investor->created_at
            ]);
             // adding entries to leadger of opening bakance of equity
            $investor->leadgerEntries()->create([
                'account_id' => $investor_eqt->id,
                'investor_id'=>$investor->id,
                'value' => 0,
                'date' => $investor->created_at

            ]);

            $expense_head = new  ExpenseHead();
            $expense_head->name = 'bank charges';
            $expense_head->save();

        } 
    }
}
