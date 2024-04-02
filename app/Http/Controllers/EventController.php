<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
   public function all(){
    // return Event::all();


    return DB::table("events")
           ->orderBy(DB::raw("DATE_FORMAT(date,'%d-%M-%Y')"), 'DESC')
           ->where('status','=',1)
           ->get();

   }
   public function add(Request $request){
    $event = new Event();
    $event->date = $request->date;
    $event->title = $request->title;
    $event->description = $request->description;
    $event->save();

    return;
   }

   public function delete(Request $request){
    $id = $request->id;
    $event = Event::find($id);
    $event->status=0;
    $event->removed_at =date('Y-m-d H:i:s');
    $event->save();

    return;
   }

}