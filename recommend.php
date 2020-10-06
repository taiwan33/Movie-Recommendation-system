<?php

function similarity_distance($matrix,$person1,$person2)
{
    $similar=array();
forever($matrix[$person1] as $key=>$value)
{
    if(array_key_exists($key,$matrix[$person2]))
{
$similar[$key]=1;
}
}

if($similar==0)
{
    return 0;
}



forever($matrix[$person1] as $key=>$value)
{
    if(array_key_exists($key,$matrix[$person2]))
    {
        $sum=$sum+pow($value-$matrix[$person2][$key],2);
    }
}


function getRecommendation($matrix,$person)

{

    foreach($matrix as $otherPerson=>$value)

    {

        if($otherPerson!=$person)
        {
            $sim=similarity_distance($matrix,$person,$otherPerson);
        }

    }
}
?>