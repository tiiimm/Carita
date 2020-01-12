<?php

namespace App\Http\Controllers;

use App\WatchLog;
use Illuminate\Http\Request;

class WatchLogController extends Controller
{
    public function get_donations()
    {
        try {
            $user = \App\User::findOrFail(request('user_id'));

            $january = $user->watch_log()
            ->whereMonth('created_at', '1')
            ->whereYear('created_at', request('year'))
            ->count();   

            $february = $user->watch_log()
            ->whereMonth('created_at', '2')
            ->whereYear('created_at', request('year'))
            ->count();   

            $march = $user->watch_log()
            ->whereMonth('created_at', '3')
            ->whereYear('created_at', request('year'))
            ->count();    

            $april = $user->watch_log()
            ->whereMonth('created_at', '4')
            ->whereYear('created_at', request('year'))
            ->count();    

            $may = $user->watch_log()
            ->whereMonth('created_at', '5')
            ->whereYear('created_at', request('year'))
            ->count();      

            $june = $user->watch_log()
            ->whereMonth('created_at', '6')
            ->whereYear('created_at', request('year'))
            ->count();     

            $july = $user->watch_log()
            ->whereMonth('created_at', '7')
            ->whereYear('created_at', request('year'))
            ->count();      

            $august = $user->watch_log()
            ->whereMonth('created_at', '8')
            ->whereYear('created_at', request('year'))
            ->count();      

            $september = $user->watch_log()
            ->whereMonth('created_at', '9')
            ->whereYear('created_at', request('year'))
            ->count();    

            $october = $user->watch_log()
            ->whereMonth('created_at', '10')
            ->whereYear('created_at', request('year'))
            ->count();    

            $november = $user->watch_log()
            ->whereMonth('created_at', '11')
            ->whereYear('created_at', request('year'))
            ->count();    

            $december = $user->watch_log()
            ->whereMonth('created_at', '12')
            ->whereYear('created_at', request('year'))
            ->count(); 
            
            $total_donations = $january + $february + $march + $april + $may + $june + $july + $august + $september + $october + $november + $december;
            
            return ['january'=>$january, 'february'=>$february, 'march'=>$march, 'april'=>$april, 'may'=>$may, 'june'=>$june, 'july'=>$july, 'august'=>$august, 'september'=>$september, 'october'=>$october, 'november'=>$november, 'december'=>$december, 'total_donations'=>$total_donations];
        }
        catch(Exception $error)
        {
            return json_encode(['message'=>$error]);
        }
    }

    public function get_supports()
    {
        try {
            $user = \App\User::findOrFail(request('user_id'));

            $january = $user->charity->watchable()
            ->whereMonth('created_at', '1')
            ->whereYear('created_at', request('year'))
            ->count();      

            $february = $user->charity->watchable()
            ->whereMonth('created_at', '2')
            ->whereYear('created_at', request('year'))
            ->count();      

            $march = $user->charity->watchable()
            ->whereMonth('created_at', '3')
            ->whereYear('created_at', request('year'))
            ->count();      

            $april = $user->charity->watchable()
            ->whereMonth('created_at', '4')
            ->whereYear('created_at', request('year'))
            ->count();      

            $may = $user->charity->watchable()
            ->whereMonth('created_at', '5')
            ->whereYear('created_at', request('year'))
            ->count();      

            $june = $user->charity->watchable()
            ->whereMonth('created_at', '6')
            ->whereYear('created_at', request('year'))
            ->count();      

            $july = $user->charity->watchable()
            ->whereMonth('created_at', '7')
            ->whereYear('created_at', request('year'))
            ->count();      

            $august = $user->charity->watchable()
            ->whereMonth('created_at', '8')
            ->whereYear('created_at', request('year'))
            ->count();      

            $september = $user->charity->watchable()
            ->whereMonth('created_at', '9')
            ->whereYear('created_at', request('year'))
            ->count();      

            $october = $user->charity->watchable()
            ->whereMonth('created_at', '10')
            ->whereYear('created_at', request('year'))
            ->count();      

            $november = $user->charity->watchable()
            ->whereMonth('created_at', '11')
            ->whereYear('created_at', request('year'))
            ->count();      

            $december = $user->charity->watchable()
            ->whereMonth('created_at', '12')
            ->whereYear('created_at', request('year'))
            ->count();

            $events = $user->charity->events;
            $january_charity = 0;
            $february_charity = 0;
            $march_charity = 0;
            $april_charity = 0;
            $may_charity = 0;
            $june_charity = 0;
            $july_charity = 0;
            $august_charity = 0;
            $september_charity = 0;
            $october_charity = 0;
            $november_charity = 0;
            $december_charity = 0;

            foreach($events as $event) {
                $january_charity += $event->watchable()
                ->whereMonth('created_at', '1')
                ->whereYear('created_at', request('year'))
                ->count();

                $february_charity += $event->watchable()
                ->whereMonth('created_at', '2')
                ->whereYear('created_at', request('year'))
                ->count();

                $march_charity += $event->watchable()
                ->whereMonth('created_at', '3')
                ->whereYear('created_at', request('year'))
                ->count();

                $april_charity += $event->watchable()
                ->whereMonth('created_at', '4')
                ->whereYear('created_at', request('year'))
                ->count();

                $may_charity += $event->watchable()
                ->whereMonth('created_at', '5')
                ->whereYear('created_at', request('year'))
                ->count();

                $june_charity += $event->watchable()
                ->whereMonth('created_at', '6')
                ->whereYear('created_at', request('year'))
                ->count();

                $july_charity += $event->watchable()
                ->whereMonth('created_at', '7')
                ->whereYear('created_at', request('year'))
                ->count();

                $august_charity += $event->watchable()
                ->whereMonth('created_at', '8')
                ->whereYear('created_at', request('year'))
                ->count();

                $september_charity += $event->watchable()
                ->whereMonth('created_at', '9')
                ->whereYear('created_at', request('year'))
                ->count();

                $october_charity += $event->watchable()
                ->whereMonth('created_at', '10')
                ->whereYear('created_at', request('year'))
                ->count();

                $november_charity += $event->watchable()
                ->whereMonth('created_at', '11')
                ->whereYear('created_at', request('year'))
                ->count();

                $december_charity += $event->watchable()
                ->whereMonth('created_at', '12')
                ->whereYear('created_at', request('year'))
                ->count();
            }

            $total_supports = $january + $february + $march + $april + $may + $june + $july + $august + $september + $october + $november + $december;

            $total_events_points = $january_charity + $february_charity + $march_charity + $april_charity + $may_charity + $june_charity + $july_charity + $august_charity + $september_charity + $october_charity + $november_charity + $december_charity;

            return ['january'=>$january, 'february'=>$february, 'march'=>$march, 'april'=>$april, 'may'=>$may, 'june'=>$june, 'july'=>$july, 'august'=>$august, 'september'=>$september, 'october'=>$october, 'november'=>$november, 'december'=>$december,

            'january_charity'=>$january_charity, 'february_charity'=>$february_charity, 'march_charity'=>$march_charity, 'april_charity'=>$april_charity, 'may_charity'=>$may_charity, 'june_charity'=>$june_charity, 'july_charity'=>$july_charity, 'august_charity'=>$august_charity, 'september_charity'=>$september_charity, 'october_charity'=>$october_charity, 'november_charity'=>$november_charity, 'december_charity'=>$december_charity,

            'total_supports'=> $total_supports, 'total_events_points'=> $total_events_points];
        }
        catch(Exception $error)
        {
            return json_encode(['message'=>$error]);
        }
    }

    public function get_admin_donations()
    {
        try {
            $inputs = array();
            $inputs = file_get_contents('php://input');
            $inputs = json_decode($inputs);

            $january = WatchLog::whereMonth('created_at', '1')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '1')
            ->whereYear('created_at', request('year'))
            ->count();      

            $february = WatchLog::whereMonth('created_at', '2')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '2')
            ->whereYear('created_at', request('year'))
            ->count();      

            $march = WatchLog::whereMonth('created_at', '3')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '3')
            ->whereYear('created_at', request('year'))
            ->count();      

            $april = WatchLog::whereMonth('created_at', '4')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '4')
            ->whereYear('created_at', request('year'))
            ->count();      

            $may = WatchLog::whereMonth('created_at', '5')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '5')
            ->whereYear('created_at', request('year'))
            ->count();      

            $june = WatchLog::whereMonth('created_at', '6')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '6')
            ->whereYear('created_at', request('year'))
            ->count();      

            $july = WatchLog::whereMonth('created_at', '7')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '7')
            ->whereYear('created_at', request('year'))
            ->count();      

            $august = WatchLog::whereMonth('created_at', '8')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '8')
            ->whereYear('created_at', request('year'))
            ->count();      

            $september = WatchLog::whereMonth('created_at', '9')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '9')
            ->whereYear('created_at', request('year'))
            ->count();      

            $october = WatchLog::whereMonth('created_at', '10')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '10')
            ->whereYear('created_at', request('year'))
            ->count();      

            $november = WatchLog::whereMonth('created_at', '11')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '11')
            ->whereYear('created_at', request('year'))
            ->count();      

            $december = WatchLog::whereMonth('created_at', '12')
            ->whereYear('created_at', request('year'))
            ->count() 
            + 
            EventWatchLog::whereMonth('created_at', '12')
            ->whereYear('created_at', request('year'))
            ->count();   
            
            $total_donations = $january + $february + $march + $april + $may + $june + $july + $august + $september + $october + $november + $december;
            
            return ['january'=>$january, 'february'=>$february, 'march'=>$march, 'april'=>$april, 'may'=>$may, 'june'=>$june, 'july'=>$july, 'august'=>$august, 'september'=>$september, 'october'=>$october, 'november'=>$november, 'december'=>$december, 'total_donations'=>$total_donations];
        }
        catch(Exception $error)
        {
            return json_encode(['message'=>$error]);
        }
    }
}
