import React from  'react'
import {Modal,Form,Input,message} from 'antd'
import  ProjectFileUpload from './ProjectFileUpload'
import axios from 'axios'

class  GoodOrder extends React.Component{
  constructor(props){
    super(props)
  }
  render() {
    const {
      visible, onCancel, onCreate, form,onChange
    } = this.props;
    const {getFieldDecorator } = form;
    return (
      <div>
        <Modal
          title="提交申请"
          visible={visible}
          onOk={onCreate}
          onCancel={onCancel}
        >
          <Form>
            <Form.Item>
              {getFieldDecorator ('msg',{
                rules:[
                  {required:true,message:'请填写声请理由'},
                  {min:2,message:'最少输入两个字符'},
                  {whitespace:true,message:"不能输入空字符串"},
                  {max:150,message:"最多输入150个字符"},
                  ]
              })(
                <Input.TextArea placeholder="请填写声请理由"/>
              )}
            </Form.Item>
            <Form.Item>
              {getFieldDecorator("file")(
                <ProjectFileUpload onChange={this.props.onChange} filemaxlenght={3}  listtyp="picture" uploadtitle="请上传您作品，最多三个文件"/>
              )}
            </Form.Item>
          </Form>
        </Modal>

      </div>
    );
  }
}
const GoodOrders = Form.create({name:'goods_order'})(GoodOrder);

class ProjectModal extends  React.Component{
  constructor(props){
    super(props)
    this.state = {visible:false,fileList:[],msg:"",file:[]}
  }
  showModal = (e) => {
    const isRenz  = this.props.userinfo.userinfo.userstate == "未认证" && parseInt(this.props.userinfo.projectinfo.price)>1000
    console.log(this.props.userinfo.userinfo);
    const userId = localStorage.getItem("hyquser_id");
    if(localStorage.getItem("reId")==userId){
     alert("自己不能申请自己发布的任务!")
    }else{
      this.setState({visible:true})
    }
   /* if(isRenz){
      if(this.props.userinfo.userinfo.person){
      alert(this.props.userinfo.userinfo.person.state);
    }else{
      alert(this.props.userinfo.userinfo.company.state);
    }
    }else {
      this.setState({visible:true})
      if(this.props.userinfo.userinfo.geti==" "){
      // window.location.href="/wl/hqy.html?id="+localStorage.getItem("hyquser_id")+"&to="+localStorage.getItem("hyqutoken")+""
      }
    }*/


  }

  handleCancel = (e) => {
    this.setState({visible:false})
  }
  saveFormRef = (formRef) => {
    this.formRef = formRef;
  }

  handleCreate  = () => {
    const filelist = this.state.file.map((key) =>{
      return key
    })
    const form = this.formRef.props.form;
    const _that =this;
    form.validateFields((err,values) =>{
      if(err){
        return
      }
      form.resetFields();
      this.setState({visible:false});
      _that.setState({msg:values.msg})
      axios.post("/user/goods_order/add",{
        user_id_check:_that.props.userinfo.user_id_check,
        token_check:_that.props.userinfo.token_check,
        goods_id:_that.props.userinfo.projectinfo.id,
        msg:values.msg,
        file:filelist.join(",")
      }).then(function (response) {
        if(response.res === 0){
          message.error(response.data)
        }else{
          message.success("申请成功")
        }
      }).catch(function (err) {
        alert(err)
      })
    })

  }
  onChange = (value) => {
    this.setState({file:value})
  };
  render() {
    return (
      <div>
        <button className="btn btn-warning text-white px-4 pt-2"  onClick={this.showModal}>申请项目</button>
        <GoodOrders
          wrappedComponentRef={this.saveFormRef}
          visible = {this.state.visible}
          onCancel={this.handleCancel}
          onCreate={this.handleCreate}
          onChange={this.onChange}
          onRemove = {this.onRemove}
        />
      </div>
    );
  }
}
export  default ProjectModal;
