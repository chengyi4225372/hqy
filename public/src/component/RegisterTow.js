import React from 'react'
import {Form,Icon,Input,Button,Cascader,InputNumber,Select,Radio,Row,Col} from 'antd'
import Upload from "./project/Upload";
const RadioGroup = Radio.Group;
let id = 0;
class TowForm extends React.Component {
  constructor(props) {
    super(props)
  }
  onChangepic = (url) =>{
    this.setState({pic:url})
  }
  onChangepicf = (url) =>{
    this.setState({picf:url})
  }
  handleSubmit = (e) =>{
    e.preventDefault();
    const _that = this
    this.props.form.validateFields((err,vlaues)=> {
      if (err) {
        return
      }
      vlaues.picf=this.state.picf
      _that.props.submitFormTow(vlaues)
    })
  }
  render() {
    const inputwidth={width:"100%"}
    const {getFieldDecorator,getFieldValue} = this.props.form;
    const formItemLayout = {
      labelCol: {
        xs: { span: 24 },
        sm: { span: 8 },
      },
      wrapperCol: {
        xs: { span: 24 },
        sm: { span: 16 },
      },
    };
    const tailFormItemLayout = {
      wrapperCol: {
        xs: {
          span: 24,
          offset: 0,
        },
        sm: {
          span: 16,
          offset: 8,
        },
      },
    };

    return (
      <Form {...formItemLayout} className={this.props.className} onSubmit={this.handleSubmit}>
        <Form.Item  label="姓名">
          {getFieldDecorator("name",{
            rules:[
              {required:true,message:"请填写您的姓名"},
              {whitespace:true,message:'不能包含空字符串'},
              {pattern:/^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,20}$/,message:"姓名格式不正确"}
            ]
          })(
            <Input placeholder="请填写您的姓名"  />
          )}
        </Form.Item>
        <Form.Item  label="身份证号码">
          {getFieldDecorator("code",{
            rules:[
              {required:true,message:"请填写身份证号码"},
              {whitespace:true,message:'不能包含空字符串'},
              {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写身份证号码"  />
          )}
        </Form.Item>
        <Form.Item label="请上身份证正面照片">
          {getFieldDecorator("pic",{
            rules:[{required:true,message:'请上身份证正面照片'}]
          })(
            <Upload filemaxlenght={1}
                    onChange={this.onChangepic} uploadtitle="请上身份证正面照片" listtyp="picture-card"/>
          )}
        </Form.Item>
        <Form.Item label="请上身份证反面照片">
          {getFieldDecorator("picf",{
            rules:[{required:true,message:'请上身份证正面照片'}]
          })(
            <Upload filemaxlenght={1}
                    onChange={this.onChangepicf} uploadtitle="请上身份证正面照片" listtyp="picture-card"/>
          )}
        </Form.Item>
        <Form.Item {...tailFormItemLayout}>
          <Button type="primary"  className="mb-5" htmlType="submit" >下一步</Button>
        </Form.Item>
      </Form>
    );
  }
}
const RegisterTow = Form.create({name:"register_tow"})(TowForm)
export default RegisterTow;
