<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Http\Controllers\Traffic;
use App\Models\customizationModel;
use App\Models\Authentication;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie; 
use Illuminate\Support\Facades\File;
use Jenssegers\Agent\Agent;

class TenancyController extends Controller
{
    
    protected $customization_model; 
    protected $traffic; 
    protected $authentication;
    public function __construct()
    {
         
        $this->customization_model = new customizationModel();  
        $this->traffic = new Traffic();  
        $this->authentication = new Authentication();        
    } 

    public function DisconnectDB(){
        $url = url()->previous(); 
        $path = parse_url($url, PHP_URL_PATH);  
        $lastSegment = last(explode('/', trim($path, '/')));  

        $page_list = ["dashboard"];


        if (in_array($lastSegment, $page_list)) {
            \DB::disconnect();
        } 
    }

    public function add_new_device($ip,$path,$encId,$device,$browser,$hostName){
             
        $newDevice = [
            'id' => $encId,
            'ip' => $ip,
            'device' => $device,
            'browser' => $browser,
            'host' => $hostName
        ];

        // Get existing data
        $data = [];

        if (File::exists($path)) {
            $data = json_decode(File::get($path), true) ?? [];
        }

        // Convert to collection
        $collection = collect($data);

        // Find index of existing device
        $index = $collection->search(function ($item) use ($newDevice) {
            return $item['id'] === $newDevice['id'];
        });

        if ($index !== false) {
            // ✅ Update existing device
            $data[$index] = $newDevice;
        } else {
            // ✅ Add new device
            $data[] = $newDevice;
        }

        // Save back to file
        File::put($path, json_encode($data, JSON_PRETTY_PRINT));

    }

    


    public function getHostName(Request $request){
        $hostName = $request->query('hostName'); 
        $userAgent = request()->userAgent();  
        $agent = new Agent(); 
        $device = ($agent->device()) ? $agent->device() : "unkown device";
        $platform = ($agent->platform()) ? $agent->platform() : "unkown platform";
        $browser = ($agent->browser()) ? $agent->browser() : "unkwon browser"; 
        $encId = $this->authentication->f_endecrypt($device.$browser,'e',"ftsi"); 
        $path = public_path('storage/devicelist.json'); 
        $this->add_new_device($this->traffic->getUserIP(),$path,$encId,$device,$browser,$hostName);
         

        if(!empty(session()->get('hostName'))){
                $this->DisconnectDB();  
                Session::flush();
                session::regenerate();
        }  

        session()->put('hostName', value:$hostName); 
        session()->put('active', value:1); 
        return redirect('https://pf.smartbooks.ph/kiosk?hostName='.$hostName); 
    }  

}
