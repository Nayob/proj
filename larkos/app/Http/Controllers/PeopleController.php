<?php
	namespace App\Http\Controllers;
    
    use App\Http\Requests\StorePeopleRequest;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use App\Models\People;
    

	
	class PeopleController extends Controller
	{
                public function store(StorePeopleRequest $request) {

                        $name = $request->input('name');
                        $email = $request->input('email');
                        $phone = $request->input('phone');
                        $cleaned_phone = preg_replace('/[^0-9]/', '', $phone);
                        $file = $request->file('avatar');
                        $filename = $file->getClientOriginalName();
                        $filepath = $file->store('uploads');
                        // return $request;



                        People::create([
                                'name' => $name,
                                'email' => $email,
                                'phone' => $cleaned_phone,
                                'filename' => $filename,
                                'filelink' => $filepath,
                                ]);

                    return response()->json(['message' => 'OK'], 200);
                }
	}