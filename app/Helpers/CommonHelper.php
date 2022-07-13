<?php
use Illuminate\Support\Facades\Storage;

if(!function_exists('storage_link')){

 function storage_link($file_path){
     return url('/').Storage::disk('local')->url($file_path);
  }

}

if(!function_exists('storage_delete')){

 function storage_delete($file_path){
     return Storage::disk('local')->delete($file_path);
  }

}

