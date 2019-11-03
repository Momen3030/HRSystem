<?php

namespace App\Http\Controllers\HR;
use App\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class HrController extends Controller
{
    public function index(){

        return view('admin.dashbord');
//     dd($date1);
    }
    public  function createDB(){
        $dbname=auth()->user()->name.'_db';
        $schemaName = $dbname?: config("database.connections.mysql.database");
        $charset = config("database.connections.mysql.charset",'utf8');
        $collation = config("database.connections.mysql.collation",'utf8_unicode_ci');
        config(["database.connections.mysql.database" => null]);
        $query = "CREATE DATABASE IF NOT EXISTS $schemaName CHARACTER SET $charset COLLATE $collation;";
        config(["database.connections.mysql.database" => $schemaName]);
        DB::statement($query);
        $CreatUsersTable="CREATE TABLE IF NOT EXISTS $dbname.users( id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(30) NOT NULL,
    last_name VARCHAR(30) NOT NULL,
    email VARCHAR(70) NOT NULL UNIQUE);";
        DB::statement($CreatUsersTable);
//        dd($creattable);
         return redirect('/dashbord');
      }

}
