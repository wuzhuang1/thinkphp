<?php
/**
 * Created by PhpStorm.
 * User: 升值中
 * Date: 2017-08-10
 * Time: 15:09
 */
namespace Admin\Controller;
use Admin\Model\RepairModel;

class RepairController extends AdminController{
    //展示
    public function index(){
        $pid = i('get.pid', 0);
        /* 获取频道列表 */
        $map  = array('status' => 1);
        $list = M('repair')->where($map)->select();
        $this->assign('list', $list);
        $this->assign('pid', $pid);
        $this->meta_title = '在线报修';
        $this->display('from');
    }

    /**
     * 添加频道
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    //添加
    public function add(){
        if(IS_POST){
            $Channel = new RepairModel();
            $data = $Channel->create();
//            dump($data);exit;
            if($data){
//                dump($data);exit;
                $id = $Channel->add();
//                exit;
                if($id){
//                    dump($Channel->getLastSql());exit;
                    $this->success('新增成功', U('index'));
                    //记录行为
                    action_log('update_channel', 'channel', $id, UID);
                } else {
                    $this->error('新增失败');
                }
            } else {
                $this->error($Channel->getError());
            }
        } else {
            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('Channel')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }

            $this->assign('pid', $pid);
            $this->meta_title = '新增导航';
            $this->display('add');
        }
    }

    /**
     * 编辑频道
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function edit($id = 0){
        if(IS_POST){
            $Channel = D('repair');
            $data = $Channel->create();
            if($data){
                if($Channel->save()){
                    //记录行为
                    //action_log('update_channel', 'channel', $data['id'], UID);
                    $this->success('编辑成功', U('index'));
                } else {
                    $this->error('编辑失败');
                }

            } else {
                $this->error($Channel->getError());
            }
        } else {
            $info = array();
            /* 获取数据 */
            $info = M('Channel')->find($id);

            if(false === $info){
                $this->error('获取配置信息错误');
            }

            $pid = i('get.pid', 0);
            //获取父导航
            if(!empty($pid)){
                $parent = M('repair')->where(array('id'=>$pid))->field('title')->find();
                $this->assign('parent', $parent);
            }

            $this->assign('pid', $pid);
            $this->assign('info', $info);
            $this->meta_title = '编辑导航';
            $this->display('add');
        }
    }

    /**
     * 删除频道
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public function del(){
        $id = array_unique((array)I('id',0));

        if ( empty($id) ) {
            $this->error('请选择要操作的数据!');
        }

        $map = array('id' => array('in', $id) );
        if(M('Repair')->where($map)->delete()){
            //记录行为
            action_log('update_channel', 'channel', $id, UID);
            $this->success('删除成功');
        } else {
            $this->error('删除失败！');
        }
    }
}