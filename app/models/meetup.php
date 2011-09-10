<?php

class Meetup extends AppModel {

    var $useTable = false;
    var $groupUrl = 'bostonphp';
    var $meetupKey = MEETUP_API_KEY;
    var $meetupLink = 'http://api.meetup.com';

    // https://api.meetup.com/groups.json/?group_urlname=bostonphp&key=123456
    function getEvents( ) {
    
        $link  = $this->meetupLink;
        $link .= "/events.json"; 
        $link .= "?group_urlname={$this->groupUrl}";      
        $link .= "&before=12m";      
        $link .= "&after=0d";      
        //$link .= "&status=upcoming";      
        $link .= "&key={$this->meetupKey}";         

        $results = $this->_getResponse( $link );          
    
        foreach ( $results['results'] AS $result ) {
            $events[ $result["id"] ] = $result['name'];
        }
                
        return( $events );
    }

    
    // http://www.meetup.com/meetup_api/docs/#rsvps
    function getRsvps( $event_id ) {

        $link  = $this->meetupLink;
        $link .= "/rsvps"; 
        $link .= "?event_id={$event_id}";
        $link .= "&page=200";         
        $link .= "&key={$this->meetupKey}";         

        $query_data = $this->_getResponse( $link );          
        $data[] = $query_data;
        // return $query_data['results'];
        
        // Must be another page
        while( $query_data['meta']['count'] == 200 ) {     
            $query_data = $this->_getResponse( $query_data['meta']['next'] );
            $data[] = $query_data;
        }
        
        // Merge all records
        foreach( $data as $dataSection ) {
            foreach( $dataSection['results'] AS $dataMerger ) {
                if( $dataMerger['response'] != 'yes' ) continue;
                $newData[] = $dataMerger;
            }
        }

        return $newData;
        
    }    
    
    // http://www.meetup.com/meetup_api/everywhere/#events_query
    function getEvent( $event_id ) {

        $link  = $this->meetupLink;
        $link .= "/events"; 
        $link .= "?id={$event_id}";
        $link .= "&key={$this->meetupKey}";         

        return $this->_getResponse( $link );          
        
    }
    
    function checkIns( $event_id ) {
        $link  = $this->meetupLink;
        $link .= "/2/checkins.json"; 
        $link .= "?event_id={$event_id}";
        $link .= "&key={$this->meetupKey}";         

        return $this->_getResponse( $link );          

    }
    
    function checkIn( $event_id ) {
        $link  = $this->meetupLink;
        $link .= "2/checkin.xml"; 
        $link .= "?event_id={$event_id}";
        $link .= "?comment=test";
        $link .= "&key={$this->meetupKey}";         

        return $this->_postResponse( $link );          

    }    
    
    private function _getResponse( $link ) {

        //get the request from the web
        App::import('Core', 'HttpSocket');
        $HttpSocket = new HttpSocket();
        $response = $HttpSocket->get($link);         
         
        //Remove non ascii chars - JSON will break because Meetup allows non-ascii characters 
        //hack from http://www.stemkoski.com/php-remove-non-ascii-characters-from-a-string/ 
        $response = str_replace("\n","[NEWLINE]",$response); 
        $response = preg_replace('/[^(\x20-\x7F)]*/','', $response); 
        $response = str_replace("[NEWLINE]","\n",$response); 
         
        //decode the returned JSON into a PHP array 
        $my_array = json_decode( $response, true ); 

        return( $my_array );         

    }

    private function _postResponse( $link ) {

        //get the request from the web
        App::import('Core', 'HttpSocket');
        $HttpSocket = new HttpSocket();
        $response = $HttpSocket->post($link);         
         
        //Remove non ascii chars - JSON will break because Meetup allows non-ascii characters 
        //hack from http://www.stemkoski.com/php-remove-non-ascii-characters-from-a-string/ 
        $response = str_replace("\n","[NEWLINE]",$response); 
        $response = preg_replace('/[^(\x20-\x7F)]*/','', $response); 
        $response = str_replace("[NEWLINE]","\n",$response); 
         
        //decode the returned JSON into a PHP array 
        $my_array = json_decode( $response, true ); 

        return( $my_array );         

    }


}
?>