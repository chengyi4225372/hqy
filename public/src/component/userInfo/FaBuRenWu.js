import React from 'react'
import {Form,Input,Radio,InputNumber,DatePicker,Button,Modal,message} from 'antd'
import axios from 'axios'
import BorderShadowWrap from "../BorderShadowWrap";
import moment from 'moment'
const RadioGroup = Radio.Group;
const { RangePicker } = DatePicker;

function disabledDate(current) {
  return current && current < moment().startOf('day');
}
class Fabuform extends React.Component{
  constructor(props){
    super(props)
    this.state = {
      formLayout: 'horizontal',
      visible:false
    };
    this.handleSubmit = this.handleSubmit.bind(this)
  }
  handleOk = (e) => {
    this.props.form.resetFields()
    this.setState({
      visible: false,
    });
    const _that =this
    const user_id_check = localStorage.getItem("hyquser_id")
    const token_check = localStorage.getItem("hyqutoken")
    axios.post("/user/goods/add",{
      user_id_check:user_id_check,
      token_check:token_check ,
      title:_that.state.form.title,
      titletype:_that.state.form.tasktype,
      price:_that.state.form.price,
      pricetype:_that.state.form.method,
      address:_that.state.form.address,
      timeb:_that.state.form.timeb,
      timee:_that.state.form.timee,
      des:_that.state.form.des,
    }).then(function (response) {
      if(response.data.res === 1){
        message.success("发布成功");

      }else {
        message.error(response.data.err);
      }
    })
  }

  handleCancel = (e) => {
    console.log(e);
    this.setState({
      visible: false,
    });
  }
  handleSubmit(e){
    e.preventDefault();
    const _that = this
    this.props.form.validateFields((err,feidsValues)=>{
      if(!err){
        console.log(feidsValues)
        feidsValues.timeb=feidsValues.time[0].format("YYYY-MM-DD");
        feidsValues.timee=feidsValues.time[1].format("YYYY-MM-DD");
        _that.setState({visible:true,form:feidsValues})
      }
    })
  }
  render(){
    const {getFieldDecorator} = this.props.form
    const inputwidth={width:"100%"}
    return(
      <BorderShadowWrap title={'任务发布'}>
        <Form layout={this.state.formLayout} onSubmit={this.handleSubmit}>
          <Form.Item label="发布任务">
            {getFieldDecorator("title",{
              rules:[
                {min:3,message:"标题不能过短"},
                {max:20,message:"标题不能过长"},
                {required:true,message:"任务名称不能为空"},
                {whitespace:true,message:"不能输入空字符串"}
              ]
            })(
              <Input placeholder="请输入任务名称最多20个字符"/>
            )}
          </Form.Item>
          <Form.Item label="任务类型选择">
            {getFieldDecorator("tasktype",{
              rules:[
                {required:true,message:"任务类型选择不能为空"},
              ]
            })(
              <RadioGroup>
                <Radio value={1}>兼职</Radio>
                <Radio value={2}>全职</Radio>
                <Radio value={3}>其他</Radio>
              </RadioGroup>
            )}
          </Form.Item>
          <Form.Item label="项目金额">
            {getFieldDecorator("price",{
              rules:[
                {required:true,message:"项目金额不能为空"},
              ]
            })(
              <InputNumber style={inputwidth} placeholder="输入项目金额"  max={999999999}/>
            )}
          </Form.Item>
          <Form.Item label="结算方式">
            {getFieldDecorator("method",{
              rules:[
                {required:true,message:"请选择结算方式"},
              ]
            })(
              <RadioGroup>
                <Radio value={1}>月结</Radio>
                <Radio value={2}>日结</Radio>
                <Radio value={3}>其他</Radio>
              </RadioGroup>
            )}
          </Form.Item>
          <Form.Item label="职位描述">
            {getFieldDecorator("des",{
              rules:[
                {required:true,message:"请输入该职位的具体事务"},
                {min:10,message:"最少输入10个字符"},
                {max:150,message:"最多输入150个字符"},
                {whitespace:true,message:"不能输入空字符串"}
              ]
            })(
              <Input.TextArea placeholder="请输入该职位的具体事务"/>
            )}
          </Form.Item >
          <Form.Item label="请选择工作时间">
            {getFieldDecorator('time', {
              rules:[{required:true,message:'请选择时间'}]
            })(
              <RangePicker disabledDate={disabledDate} style={inputwidth} />
            )}
          </Form.Item>
          <Form.Item label="工作地点">
            {getFieldDecorator("address",{
              rules:[
                {min:1,message:"最少输入一个字符"},
                {max:30,message:"最多输入30个字符"},
                {required:true,message:"任务名称不能为空"},
                {whitespace:true,message:"不能输入空字符串"}
              ]
            })(
              <Input placeholder="请输入工作地点如:网络,在线主播,读书馆,驻场"/>
            )}
          </Form.Item>
          <Form.Item >
            <Button type="primary" htmlType="submit">
              发布
            </Button>
          </Form.Item>
          <Form.Item>
            <Modal
              title="确认发布"
              visible={this.state.visible}
              onOk={this.handleOk}
              onCancel={this.handleCancel}
            >
              <p>任务发布成功</p>
              <p>新发任务需<span className="text-warning">审核后</span>才能正式发布</p>
              <p>请前往个人中心查看任务状态</p>
            </Modal>
          </Form.Item>

        </Form>
      </BorderShadowWrap>

    )
  }


}

const  FabuRenWu = Form.create({name:"fabu"})(Fabuform)
export  default FabuRenWu;
