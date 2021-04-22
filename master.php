<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Master{
    private $client_id;
    private $email;
    private $name;
    
    public function __construct($client_id, $email, $name) {
        
        $this->client_id = $client_id;
        $this->email= $email;
        $this->name = $name;
    }
    
    
    /**
    * get short lived token
    * @param $url url to fetch the sl_token 
    */ 
    public function getToken($url){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\"client_id\":\"" . $this->client_id  . "\",\"email\":\"" . $this->email. "\",\"name\":\"" . $this->name.  "\"}",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response)->data;
    }
    
    /**
    * get recursively all posts of all pages
    * @param $url to get all posts from
    */
    public function getAllPosts($url){
        
        $totalPages = 10;
        $allPosts = array();
        for ($i = 1; $i <= $totalPages; $i++){
            $pageUrl = $url."&page=".$i;
            $posts = $this->getPosts($pageUrl)->posts;
            foreach ($posts as $singlePost){
                $allPosts[] = $singlePost;
            }
        }
        return $allPosts;
    }
       
    /**
    * divide all posts by months
    * @param $allPosts all posts of all pages
    */ 
    public function getPostsByMonth($allPosts){
        
        $monthPosts = array();
        foreach ($allPosts as $singlePost){
            $postMonth = ltrim(date("M",strtotime($singlePost->created_time)), "0");
            $monthPosts[$postMonth][] = $singlePost;
        }
        return $monthPosts;
    }
    
    /**
    * get average length of posts by months
    * @param $monthPosts all posts divided by months   
    */ 
    public function getAverageLength($monthPosts){
        
        $averageLength = array();
        foreach ($monthPosts as $month => $singleMonthPosts){
            $totalLength = 0;
            $totalPosts = count($singleMonthPosts);
            foreach ($singleMonthPosts as $post){
                $totalLength += strlen($post->message);
            }
            $avgMonthLength = round($totalLength/$totalPosts);
            $averageLength[$month] = $avgMonthLength;
        }
        return $averageLength;
        
    }
    
    /**
    * get longest post by months
    * @param $monthPosts all posts divided by months   
    */ 
    public function getLongestPost($monthPosts){
        
        $longPost = array();
        foreach ($monthPosts as $month => $singleMonthPosts){
            $postLength = array();
            foreach ($singleMonthPosts as $key => $post){
                $postLength[$key] = strlen($post->message);
            }
            $lengthyPostIndex = array_keys($postLength, max($postLength));
            
            $longPost[$month]['message'] = $singleMonthPosts[$lengthyPostIndex[0]]->message;
            $longPost[$month]['length'] = max($postLength);
        }
        return $longPost;
    }
    
    /**
    * get number of posts divided by week numbers
    * @param $allPosts all posts of all pages  
    */ 
    public function getPostsByWeek($allPosts){
    
        $postsByWeek = array();
        foreach ($allPosts as $singlePost){
            $weekNum = date("W", strtotime($singlePost->created_time));
            $postsByWeek[$weekNum] += 1;
        }
        return $postsByWeek;
    }
    
    /**
    * get average number of posts by users per month
    * @param $monthPosts all posts divided by months   
    */
    public function getPostsByUsers($monthPosts){
        
        $postsByUsers = array();
        foreach ($monthPosts as $month => $singleMonthPosts){

            $postsCount = count($singleMonthPosts);
            $users = array();
            foreach ($singleMonthPosts as $post){
                $users[$post->from_id] += 1;
            }
            $uniqueUsersCount = count($users);
            $avgPosts = round($postsCount/$uniqueUsersCount);
            $postsByUsers[$month] = $avgPosts;
        }
        return $postsByUsers;
    }
    
    /**
    * get all posts from a url
    * @param $url url to get all posts of all pages 
    */
    public function getPosts($url){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response)->data;
    }
}