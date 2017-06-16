<?php
/**
 * Created by PhpStorm.
 * User: mjwunderlich
 * Date: 6/16/17
 * Time: 11:13 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


/**
 * Class ApiController
 * @package App\Http\Controllers
 *
 * This class is responsible for serving the API routes for this project. It contains two endpoints:
 * - rising: returns a json array of Reddit rising posts
 * - hot: returns a json array of Reddit popular posts
 */
class ApiController extends Controller
{
    /**
     * Returns an HTTP response containing posts from the specified reddit URL.
     *
     * @param $url
     * @param bool $last_post_id
     * @param string $position
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    private function fetchPosts($url, $last_post_id = false, $position = "before")
    {
        try {
            // If next_page_id is set, then add it to the URL
            if (!!$last_post_id) {
                $url .= "?limit=25&$position=$last_post_id";
            }
            else {
                $url .= "?limit=25";
            }

            $posts = $this->curlRequest($url, true);
            $result = [];

            foreach ($posts['data']['children'] as $data) {
                // Make sure the thumbnail is valid
                $data['data']['has_thumbnail'] = filter_var($data['data']['thumbnail'], FILTER_VALIDATE_URL);
                $result[] = $data['data'];
            }

            // Successful
            return response([
                "posts" => $result,
                "next_page_id" => $posts['data']['after'],
                "prev_page_id" => $posts['data']['before']
            ], 200);

        } catch (\Exception $ex) {
            // An error was encountered
            return response(["error" => 1, "message" => $ex->getMessage()], 500);
        }
    }

    /**
     * Returns an HTTP response with HOT reddit posts.
     *
     * @param Request $request
     * @param bool $last_post_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function fetchHotPosts(Request $request, $last_post_id = false)
    {
        $position = $request->input('position');
        return $this->fetchPosts("https://www.reddit.com/hot.json", $last_post_id, $position);
    }

    /**
     * Returns an HTTP response with NEW reddit posts.
     *
     * @param Request $request
     * @param bool $last_post_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function fetchNewPosts(Request $request, $last_post_id = false)
    {
        $position = $request->input('position');
        return $this->fetchPosts("https://www.reddit.com/new.json", $last_post_id, $position);
    }

    /**
     * Returns an HTTP response with NEW reddit posts.
     *
     * @param Request $request
     * @param bool $last_post_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function fetchRisingPosts(Request $request, $last_post_id = false)
    {
        $position = $request->input('position');
        return $this->fetchPosts("https://www.reddit.com/rising.json", $last_post_id, $position);
    }

    /**
     * Performs a CURL GET request.
     *
     * @param $url
     * @param bool $as_json
     * @return mixed
     */
    private function curlRequest($url, $as_json = false)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if ($as_json) {
            return json_decode($response, true);
        }

        return $response;
    }
}
