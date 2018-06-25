<?php
/**
 * Create By guaosi
 * Author guaosi
 * Date: 2017/8/26/0026
 * Time: 10:32
 */
if (! function_exists('hidtel')) {

    function hidtel($phone){
        $IsWhat = preg_match('/(0[0-9]{2,3}[\-]?[2-9][0-9]{6,7}[\-]?[0-9]?)/i',$phone); //固定电话
        if($IsWhat == 1){
            return preg_replace('/(0[0-9]{2,3}[\-]?[2-9])[0-9]{3,4}([0-9]{3}[\-]?[0-9]?)/i','$1****$2',$phone);
        }else{
            return  preg_replace('/(1[358]{1}[0-9])[0-9]{4}([0-9]{4})/i','$1****$2',$phone);
        }
    }
}
/**
 * @param $URL 请求链接
 * @param null $data 数据 array() string
 * @param string $type 请求类型 POST GET PUT DELETE
 * @param string $headers 头部信息
 * @param string $data_type 返回数据类型 默认为json
 * @return mixed
 */
if (! function_exists('callInterfaceCommon')) {
function callInterfaceCommon($URL,$data=null,$type='POST',$headers="",$data_type='json'){
    $ch = curl_init();
    //判断ssl连接方式
    if(stripos($URL, 'https://') !== false) {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
    }
    $connttime=300; //连接等待时间500毫秒
    $timeout = 15000;//超时时间15秒

    $querystring = "";
    if (is_array($data)) {
        // Change data in to postable data
        foreach ($data as $key => $val) {
            if (is_array($val)) {
                foreach ($val as $val2) {
                    $querystring .= urlencode($key).'='.urlencode($val2).'&';
                }
            } else {
                $querystring .= urlencode($key).'='.urlencode($val).'&';
            }
        }
        $querystring = substr($querystring, 0, -1); // Eliminate unnecessary &
    } else {
        $querystring = $data;
    }

    // echo $querystring;
    curl_setopt ($ch, CURLOPT_URL, $URL); //发贴地址
    //设置HEADER头部信息
//        if($headers!=""){
//            curl_setopt ($ch, CURLOPT_HTTPHEADER, $headers);
//        }else {
//            curl_setopt ($ch, CURLOPT_HTTPHEADER, array('Content-type: text/json'));
//        }
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);//反馈信息
    curl_setopt ($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1); //http 1.1版本

    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT_MS, $connttime);//连接等待时间
    curl_setopt ($ch, CURLOPT_TIMEOUT_MS, $timeout);//超时时间

    switch ($type){
        case "GET" : curl_setopt($ch, CURLOPT_HTTPGET, true);break;
        case "POST": curl_setopt($ch, CURLOPT_POST,true);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
        case "PUT" : curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "PUT");
            curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
        case "DELETE":curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($ch, CURLOPT_POSTFIELDS,$querystring);break;
    }
    $file_contents = curl_exec($ch);//获得返回值
    // echo time().'<br>';
    $status = curl_getinfo($ch);
    //dump($status);
    curl_close($ch);
    if($data_type=="json"||$data_type=="JSON")
    {
        return json_encode($file_contents);
    }else
    {
        return $file_contents;
    }


}
}

//自动分页页码类
function autoPageNum($page,$total,$phpfile,$pagesize=10,$pagelen=7){
    $pagecode = '';//定义变量，存放分页生成的HTML
    $page = intval($page);//避免非数字页码
    $total = intval($total);//保证总记录数值类型正确
    if(!$total) return array();//总记录数为零返回空数组
    $pages = ceil($total/$pagesize);//计算总分页
    //处理页码合法性
    if($page<1) $page = 1;
    if($page>$pages) $page = $pages;
    //计算查询偏移量
    $offset = $pagesize*($page-1);
    //页码范围计算
    $init = 1;//起始页码数
    $max = $pages;//结束页码数
    $pagelen = ($pagelen%2)?$pagelen:$pagelen+1;//页码个数
    $pageoffset = ($pagelen-1)/2;//页码个数左右偏移量

    //生成html
    $pagecode='<ul class="pagination ">';
//    $pagecode.="<span>$page/$pages</span>";//第几页,共几页
    //如果是第一页，则不显示第一页和上一页的连接
    if($page!=1){
//        $pagecode.="<a href=\"{$phpfile}?page=1\">&lt;&lt;</a>";//第一页
        $pagecode.="<li class='prev'><a href='".$phpfile."?page=".($page-1)."'>上一页</a></li>";//上一页
    }
    //分页数大于页码个数时可以偏移
    if($pages>$pagelen){
        //如果当前页小于等于左偏移
        if($page<=$pageoffset){
            $init=1;
            $max = $pagelen;
        }else{//如果当前页大于左偏移
            //如果当前页码右偏移超出最大分页数
            if($page+$pageoffset>=$pages+1){
                $init = $pages-$pagelen+1;
            }else{
                //左右偏移都存在时的计算
                $init = $page-$pageoffset;
                $max = $page+$pageoffset;
            }
        }
    }
    //生成html
    for($i=$init;$i<=$max;$i++){
        if($i==$page){
            $pagecode.='<li class="active"><a href="javaScript:;">'.$i.'</a></li>';
        } else {
            $pagecode.="<li><a href='".$phpfile."?page={$i}'>".$i."</a></li>";
        }
    }
    if($page!=$pages){
        $pagecode.="<li class='next'><a href='".$phpfile."?page=".($page+1)."'>下一页</a></li>";//下一页
//        $pagecode.="<a href=\"{$phpfile}?page={$pages}\">&gt;&gt;</a>";//最后一页
    }
    $pagecode.='</ul>';
    return $pagecode;
}
