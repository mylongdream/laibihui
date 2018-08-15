<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index(Request $request)
    {
        $systeminfo['os'] = PHP_OS;
        $systeminfo['ip'] = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '/';
        $systeminfo['server_domain'] = $request->server("SERVER_NAME").' / '.$request->server("SERVER_ADDR");
        $systeminfo['web_server'] = $_SERVER['SERVER_SOFTWARE'];
        $systeminfo['php_ver'] = PHP_VERSION;
        $systeminfo['mysql_ver'] = $this->_mysql_version();
        $systeminfo['mysql_size'] = $this->_mysql_db_size();
        $systeminfo['zlib'] = function_exists('gzclose') ? 1 : 0;
        $systeminfo['safe_mode'] = (boolean) ini_get('safe_mode') ? 1 : 0;
        $systeminfo['safe_mode_gid'] = (boolean) ini_get('safe_mode_gid') ? 1 : 0;
        $systeminfo['timezone'] = function_exists("date_default_timezone_get") ? date_default_timezone_get() : 0;
        $systeminfo['socket'] = function_exists('fsockopen') ? 1 : 0;
        $systeminfo['gd'] = extension_loaded("gd") ? 1 : 0;
        $systeminfo['max_filesize'] = ini_get("file_uploads") ? ini_get('upload_max_filesize') : 0;
        return view('admin.index', ['systeminfo' => $systeminfo]);
    }

    public function updatecache(Request $request)
    {
        cache()->flush();
        if ($request->ajax()){
            return response()->json(['status' => 1, 'info' => trans('admin.cache.updatesucceed'), 'url' => back()->getTargetUrl()]);
        }else{
            return back();
        }
    }
    private function _mysql_version() {
        $version = DB::select("select version() as ver");
        return $version[0]->ver;
    }

    private function _mysql_db_size() {
        $dbsize = 0;
        $tables = DB::select("SHOW TABLE STATUS LIKE '".config('database.connections.mysql.prefix')."%'");
        foreach ($tables as $table) {
            $dbsize += $table->Data_length + $table->Index_length;
        }
        return size_count($dbsize);
    }

}
