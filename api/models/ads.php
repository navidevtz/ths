<?

require_once("../src/connection.php");

class Ads{

    function get(){
        $conekt = new DB;
        $con = $conekt->connect();

        $posts = array();
        $query = "SELECT * FROM posts ORDER BY id";
        $result = $con->query($query);

        while($result){
            $output = $result->fetch_assoc();

            $posts[] = array(
                'id' => $output['id'],
                'title' => $output['title'],
                'details' => $output['details'],
                'time_posted' => $output['time_posted']
            );
        }
        return $posts;
        return json_encode($posts);
    }

}
?>