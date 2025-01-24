<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FormSubmission;
use App\Models\User;
use App\Models\Site;
use App\Mail\FormSubmissionMail;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function test(){
        $formSubmission = FormSubmission::find(16);
        $mail = new FormSubmissionMail($formSubmission);
        //Mail::to("rifatalptekincetin@gmail.com")
        //->send($mail);
    }
    // get form fields and save it to FormSubmission model's fields array
    public function submit(Request $request){
        switch ($request->form_type) {
            case 'custom-form':
                $msg = "Form başarıyla gönderildi, ilgili birimlere iletilip en kısa sürede tarafınıza dönüş sağlanacaktır.";
                break;
            case "comment":
                $msg = "Yorumunuz başarıyla gönderildi, editörler tarafından incelenip onaylanacaktır.";
                break;
            case "contact":
                $msg = "Mesajınız başarıyla gönderildi, ilgili birim inceleyip size ulaşacaktır.";
                break;
            case "training":
                $msg = "Başvurunuz alındı, ilgili birim inceleyip en kısa sürede size ulaşacaktır.";
                break;
            case "seminar":
                $msg = "Başvurunuz alındı, ilgili birim inceleyip en kısa sürede size ulaşacaktır.";
                break;
            case "congress":
                $msg = "Başvurunuz alındı, ilgili birim inceleyip en kısa sürede size ulaşacaktır.";
                break;
            default:
               $msg = "Bazı form alanları bozuk gibi görünüyor, konu hakkında site yönetimi ile iletişime geçiniz.";
               return response()->json(['message' => $msg], 400);
               exit;
        }

        if(!$request->get("kvkk-onay")){
            return response()->json(['message' => "KVKK Metnini onaylamadan bu formu işleyemeyiz."], 400);
            exit;
        }

        if($request->form_type == "comment"){
            $user = User::where('id', $request->user_id)->first();
            if(!$user) return response()->json(['message' => "Bazı form alanları bozuk gibi görünüyor, konu hakkında site yönetimi ile iletişime geçiniz."], 400);
            $user->reviews()->create([
                    'rating'=> $request->rating,
                    'content'=> $request->yorum,
                    'name'=> $request->isim,
                    'email'=> $request->eposta,
                ]);
        }

        $formSubmission = new FormSubmission();
        $formSubmission->form_type = $request->form_type;
        $formSubmission->url = url()->previous();
        $formSubmission->site_id = $request->site_id;
        $formSubmission->fields = $request->except(["_token","form_type","site_id"]);
        $formSubmission->save();

        if( $request->site_id && $site = Site::where('id', $request->site_id)->first() ){
            $email = $site->email;
        }else{
            $email = config("app.admin_email");
        }

        if($request->user_id && $user = User::where('id', $request->user_id)->first()){
            $email = $user->email;
        }

        $mail = new FormSubmissionMail($formSubmission);
        Mail::to($email)
        ->send($mail);
        
        return response()->json(['message' => $msg]);
    }
}
