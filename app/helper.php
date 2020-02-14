<?php

use App\Models\Setting;
use App\Models\Token;
use Intervention\Image\ImageManagerStatic as Image;

    function apiResponse($status, $message, $data =null)
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response);
    }

    function rateCalc($rates)
    {
      $avg = array_sum($rates)/count($rates);
      $rate = number_format($avg, 1, '.', '');

      return $rate;
    }
/* NOTE: Auth Functions */
function respondWithToken($token)
  {
    return response()->json([
      'access_token' => $token,
      'token_type' => 'bearer',
      // 'expires_in' => auth()->factory()->getTTL() * 60
    ]);
  }

//Image
function imageStore($img)
  {
      $path = public_path();
      $destinationPath = $path . '/uploads/posts/'; // upload path

      $photo = $img;
      $extension = $photo->getClientOriginalExtension(); // getting image extension
      $name = time() . '' . rand(11111, 99999) . '.' . $extension; // renameing image
      $photo->move($destinationPath, $name); // uploading file to given path

    $photo = Image::make($destinationPath . $name);
    $photo->resize(300, 300)->save($destinationPath . $name, 100);

    return $name;
  }

  function settings()
  {
    $settings = Setting::find(1);
    if($settings)
    {
      return $settings;
    } else {
      return new Setting;
    }
  }

  function notifyByFirebase($title, $body, $tokens, $data = [])
{
    $registrationIDs = $tokens;

    $fcmMsg = array(
        'body' => $body,
        'title' => $title,
        'sound' => "default",
        'color' => "#203E78"
    );

    $fcmFields = array(
        'registration_ids' => $registrationIDs,
        'priority' => 'high',
        'notification' => $fcmMsg,
        'data' => (array)$data
    );


    $headers = array(
        'Authorization: key=' . env('FIREBASE_API_ACCESS_KEY'),
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

?>
