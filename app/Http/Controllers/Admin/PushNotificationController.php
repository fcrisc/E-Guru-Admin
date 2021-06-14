<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PushNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PushNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $push_notifications = PushNotification::orderBy('created_at', 'desc')->get();
        return view('admin.push_notifications.index', compact('push_notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.push_notifications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string|max:255',
            'body'  => 'required|string|max:255',
            'image' => 'image|max:1999'

        ]);

        $notification = new PushNotification();

        // if ($request->hasFile('image')) {
        //     $filename = time() . '.' . $request->image->getClientOriginalName();
        //     $request->image->storeAs('image', $filename, 'public');
        //     $notification->image = $filename;
        // }


        $notification->title = $request->get('title');
        $notification->body = $request->get('body');
        $notification->save();




        // return redirect()->route('push_notifications.index');

        function sendMessage() {
            $content      = array(
                "en" => 'Harini ada meeting tergempak'
            );
            $hashes_array = array();
            array_push($hashes_array, array(
                "id" => "like-button",
                "text" => "Like",
                "icon" => "http://i.imgur.com/N8SN8ZS.png",
                "url" => "https://yoursite.com"
            ));
            array_push($hashes_array, array(
                "id" => "like-button-2",
                "text" => "Like2",
                "icon" => "http://i.imgur.com/N8SN8ZS.png",
                "url" => "https://yoursite.com"
            ));
            $fields = array(
                'app_id' => "4df855c4-7e77-4558-8083-658361606d31",
                'included_segments' => array(
                    'Meeting Test 1'
                ),
                'data' => array(
                    "foo" => "bar"
                ),
                'contents' => $content,
                'web_buttons' => $hashes_array
            );

            $fields = json_encode($fields);
            print("\nJSON sent:\n");
            print($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json; charset=utf-8',
                'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

            $response = curl_exec($ch);
            curl_close($ch);

            return $response;
        }

        $response = sendMessage();
        $return["allresponses"] = $response;
        $return = json_encode($return);

        $data = json_decode($response, true);
        print_r($data);

        print("\n\nJSON received:\n");
        print($return);
        print("\n");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // function sendMessage() {
        //     $content      = array(
        //         "en" => 'English Message'
        //     );
        //     $hashes_array = array();
        //     array_push($hashes_array, array(
        //         "id" => "like-button",
        //         "text" => "Like",
        //         "icon" => "http://i.imgur.com/N8SN8ZS.png",
        //         "url" => "https://yoursite.com"
        //     ));
        //     array_push($hashes_array, array(
        //         "id" => "like-button-2",
        //         "text" => "Like2",
        //         "icon" => "http://i.imgur.com/N8SN8ZS.png",
        //         "url" => "https://yoursite.com"
        //     ));
        //     $fields = array(
        //         'app_id' => "5eb5a37e-b458-11e3-ac11-000c2940e62c",
        //         'included_segments' => array(
        //             'Subscribed Users'
        //         ),
        //         'data' => array(
        //             "foo" => "bar"
        //         ),
        //         'contents' => $content,
        //         'web_buttons' => $hashes_array
        //     );

        //     $fields = json_encode($fields);
        //     print("\nJSON sent:\n");
        //     print($fields);

        //     $ch = curl_init();
        //     curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //         'Content-Type: application/json; charset=utf-8',
        //         'Authorization: Basic NGEwMGZmMjItY2NkNy0xMWUzLTk5ZDUtMDAwYzI5NDBlNjJj'
        //     ));
        //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //     curl_setopt($ch, CURLOPT_HEADER, FALSE);
        //     curl_setopt($ch, CURLOPT_POST, TRUE);
        //     curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        //     $response = curl_exec($ch);
        //     curl_close($ch);

        //     return $response;
        // }

        // $response = sendMessage();
        // $return["allresponses"] = $response;
        // $return = json_encode($return);

        // $data = json_decode($response, true);
        // print_r($data);
        // $id = $data['id'];
        // print_r($id);

        // print("\n\nJSON received:\n");
        // print($return);
        // print("\n");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
