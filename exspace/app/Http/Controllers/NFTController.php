<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Nft;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Auth;

class NFTController extends Controller
{
    public function createNFT(Request $request)
    {
        $imageFile = $request->input("image");

        /*$response = http::withHeaders([
            'pinata_api_key' => '26f0951f9bda0d366c23',
            'pinata_secret_api_key' => 'd2b136a43a42f1124272c4c66bfdb48793d3e179db91abda2791ef5789d571bf'
          ])->post('https://api.pinata.cloud/pinning/pinFileToIPFS', [
              'form_params' =>[
                'file' => $imageFile
              ]
          ]);
    
          $imageHash = $response->IpfsHash();*/

        $nft = new \App\Models\Nft();
        $nft->title = $request->input('title');
        $nft->description = $request->input('description');
        $nft->price = $request->input('price');
        $nft->is_minted = false;
        //$nft->image = $imageHash;
        $nft->image = "stock image";
        $nft->user_id = Auth::user()->id;   
        $nft->save();
    }


    public function show(\App\Models\Nft $nft){
        $data['nft'] = $nft;
        return view('nft/show', $data);
    }

    public function mint($id){
        $error = "You must be the creator of this NFt to mint it.";
        $nft = Nft::where('id', $id)->first();

        if(\Auth::user()->cannot('update', $nft)){
            return $error;
        }
        $nft->is_minted = true;
        $nft->save();
        return redirect("/");
        }
}
