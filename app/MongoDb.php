<?php

namespace App;

use App\Http\Controllers\collectionsController;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Pagination;

class MongoDb 
{
	public static function collections()
	{
		$db = new \MongoDB\Client( "mongodb://localhost" );
		return $db->shieldfy->listCollections();
	}


    public static function CountTotal($name)
    {
        $db = new \MongoDB\Client( "mongodb://localhost" );
        $collection = $db->shieldfy->selectCollection($name);
        return $collection->count();
    }

    public static function pagination($name, $perPage, $pagination)
    {
        $db = new \MongoDB\Client( "mongodb://localhost" );       
        $collection = $db->shieldfy->selectCollection($name);
        return $collection->find([],['limit' => $perPage,'skip' =>$pagination->offset()]);
    }

    public static function getByID($name, $id)
    {
        $db = new \MongoDB\Client( "mongodb://localhost" );       
        $collection = $db->shieldfy->selectCollection($name);
        return $document = $collection->findOne(["_id" => new \MongoDB\BSON\ObjectID($id)]);
    }

    public static function insert($name, $document)
    {
        $db = new \MongoDB\Client( "mongodb://localhost" );
        $collection = $db->shieldfy->selectCollection($name);
        return $collection->insertOne($document);
    }

    public static function update($name, $id, $document)
    {
        $db = new \MongoDB\Client( "mongodb://localhost" );
        $collection = $db->shieldfy->selectCollection($name);
        $collection->updateOne(["_id" => new \MongoDB\BSON\ObjectID($id)],['$set' => $document]);
    }

	public static function recursive($document,$first = false, $name)
    {
        foreach($document as $key => $value)
        {	
        	echo '<ul>';
            if ($value instanceof \MongoDB\Model\BSONArray || $value instanceof \MongoDB\Model\BSONDocument) {
                $value = Self::recursive($value, false, $name);
                echo '</li>';
            } else {
                if ($key === '_id') {
                    echo '<li><a href="'.$name.'/id/'.$value.'">'.(is_numeric($key) ? '' : $key).' = '.$value.'</a>';

                    echo '<form action="'.$name.'/'.$value.'/delete" method="post">
                            <input type="hidden" name="_token" value="'.csrf_token().'" />
                            <button class="btn btn-danger" onclick="return confirm(\'Are you sure ?\');" style="float:right">Delete</button>
                          </form>';

                    echo '<a href="'.$name.'/'.$value.'/edit" class ="btn btn-success" style="float:right; margin-right:5px;"">Edit</a></li>';
                }
            }
            echo '</ul>';
            if($first) echo '<hr />';
        }

    }

    public static function factory($document)
    {
       foreach($document as $key => $value)
        {   
            echo '<ul>';
            if ($value instanceof \MongoDB\Model\BSONArray || $value instanceof \MongoDB\Model\BSONDocument) {
                echo '<li>'.(is_numeric($key) ? '' : $key);
                $value = Self::factory($value, false);
                echo '</li>';
            } else {
                echo '<li>'.(is_numeric($key) ? '' : $key).' = '.$value.'</a></li>';
                
            }

            echo '</ul>';
        }

    }

    public static function delete($coll, $id)
    {
        $db = new \MongoDB\Client( "mongodb://localhost" );
        $collection = $db->shieldfy->selectCollection($coll);
        return $collection->deleteOne(['_id' => new \MongoDB\BSON\ObjectID($id)]);
    }
	
}
