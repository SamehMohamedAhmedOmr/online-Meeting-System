<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
class DashboardController extends Controller
{
  public function filesizes()
  {
    $file_size = 0;


    foreach( File::allFiles(public_path('\storage\faculty_pic')) as $file)
    {
        $file_size += $file->getSize();
    }
    foreach( File::allFiles(public_path('\storage\subject_att')) as $file)
    {
        $file_size += $file->getSize();
    }
    foreach( File::allFiles(public_path('\storage\user_pic')) as $file)
    {
        $file_size += $file->getSize();
    }

$full=61440;
    $file_size = number_format($file_size / 1048576,2);
$full=$full-$file_size;
    return view('pages.dashboard',compact('file_size','full'));
  }
}
