<?php
namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Property;
use App\Models\Records;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

/**
 * Class DeviceController
 * @package App\Http\Controllers\Bindings
 */
class DeviceController extends Controller
{
    public function getAll(Request $request)
    {
        return Device::all();
    }

    public function getDevice(Request $request, $hostname)
    {
        $count = 0;
        $device['meta'] = Device::where('hostname', $hostname)->first();
        $properties = Property::where('device_id', $device['meta']->id)->get();
        foreach($properties as $property){
            $device['properties'][$count] =  $property;
            $device['properties'][$count]['records'] = Records::where('property_id', $property->id)
                ->orderBy('id', 'desc')->limit(3)->get();
            $count++;
        }
        return $device;
    }

    public function getProperty(Request $request, $hostname, $propertyID)
    {
        $count = 0;
        $device = Device::where('hostname', $hostname)->first();
        $properties = Property::where('id', (int)$propertyID)->where('device_id', $device->id)->get();
        foreach($properties as $property){
            $output['properties'][$count] =  $property;
            $output['properties'][$count]['records'] = Records::where('property_id', $property->id)
                ->orderBy('id', 'desc')->limit(10)->get();
            $count++;
        }
        return $output;
    }

    public function create(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'hostname' => 'required|max:255',
            'type' => 'required|max:255',
            'approved' => 'nullable|max:255'
        ])->validate();

        $device = new Device;
        $device->hostname = $request->hostname;
        $device->type = $request->type;
        $device->approved = '1'; 
        $device->token = ''; 
        $device->save();
        return "{}";
    }

    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'nullable|numeric|max:20',
            'hostname' => 'required|max:255',
            'type' => 'required|max:255',
            'approved' => 'nullable|max:255'
        ])->validate();

        Rooms::where('hostname', $request->hostname)->orwhere('id', $request->id)->update(
            [
                'hostname' => $request->new-hostname,
                'type' => $request->type,
                'approved' => $request->approved,
            ]
        );
        return "{}";
    }

    public function delete(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'nullable|numeric|max:20',
            'hostname' => 'nullable|max:255' 
        ])->validate();

        try {
            $status = Device::where('hostname', $request->hostname)->orwhere('id', $request->id)->delete();
            return '{"status": "'.($status ? "successful" : "error" ).'"}';
        } catch (\Illuminate\Database\QueryException $e) {
            return '{"status":"error", "message":"'.$e.'"}';
        }
    }
}