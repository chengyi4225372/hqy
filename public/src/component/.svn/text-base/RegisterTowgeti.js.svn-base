import React from 'react'
import {Form,Icon,Input,Button,Cascader,InputNumber} from 'antd'
import Upload from './project/Upload'
import {options} from "./contract/Option";

class TowForm extends React.Component {
  constructor(props) {
    super(props)
  }
  handleSubmit = (e) =>{
    e.preventDefault();
    const _that = this
    this.props.form.validateFields((err,vlaues)=> {
      if (err) {
        return
      }
      vlaues.pic = _that.state.pic;
      vlaues.faren_z = _that.state.faren_z;
      vlaues.faren_f = _that.state.faren_f;
      _that.props.submitFormTowgeti(vlaues)
    })
  }
  onChangepic = (url) =>{
    this.setState({pic:url})
  }
  onChangefaren_z = (url) =>{
    this.setState({faren_z:url})
  }
  onChangefaren_f = (url) =>{
    this.setState({faren_f:url})
  }
  render() {
    const inputwidth={width:"100%"}
    const {getFieldDecorator} = this.props.form
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
      <Form  {...formItemLayout} className={this.props.className}   onSubmit={this.handleSubmit}>
        <Form.Item  label="公司名称">
          {getFieldDecorator("company",{
            rules:[
              {required:true,message:"请填写公司名称"},
              {whitespace:true,message:'不能包含空字符串'},
              {min:2,message:"请填写至少4个字符"},
              {max:30,message:"最多填写30个字符"}
            ]
          })(
            <Input placeholder="请填写公司名称" />
          )}
        </Form.Item>
        <Form.Item  label="所属行业">
          {getFieldDecorator("type",{
            rules:[
              {required:true,message:"请填写所属行业"},
              {whitespace:true,message:'不能包含空字符串'},
              {min:2,message:"请填写至少2个字符"},
              {max:30,message:"最多填写30个字符"}
            ]
          })(
            <Input placeholder="请填写所属行业" />
          )}
        </Form.Item>
        <Form.Item label="营业执照">
          {getFieldDecorator("pic",{
            rules:[{required:true,message:'请上传营业执照'}]
          })(
            <Upload filemaxlenght={1}
                    onChange={this.onChangepic} uploadtitle="请上传营业执照" listtyp="picture-card"/>
          )}
        </Form.Item>
        <Form.Item  label="地址">
          {getFieldDecorator("address",{
            rules:[{required:true,message:'请选择地址'}]
          })(
            <Cascader style={inputwidth} options={options}  placeholder="请选择地址"></Cascader>
          )}
        </Form.Item>
        <Form.Item  label="常用地址">
          {getFieldDecorator("addressdtail",{
            rules:[
              {required:true,message:'请填写常用地址'},
              {whitespace:true,message:'不能包含空字符串'},
              {min:6,message:"请填写至少6个字符"},
              {max:30,message:"最多填写30个字符"}
              ]
          })(
            <Input style={inputwidth} placeholder="请填写常用地址"></Input>
          )}
        </Form.Item>
        <Form.Item  label="从业年限(单位：年)">
          {getFieldDecorator("year",{
            rules:[
              {required:true,message:'请填写从业年限'},
            ]
          })(
            <InputNumber style={inputwidth} placeholder="请填从业年限"/>
          )}
        </Form.Item>
        <Form.Item  label="法人名称">
          {getFieldDecorator("faren_name",{
            rules:[
              {required:true,message:'请填法人名称'},
              {whitespace:true,message:'不能包含空字符串'},
              {min:2,message:"请填写至少2个字符"},
              {max:4,message:"最多填写4个字符"}
            ]
          })(
            <Input style={inputwidth} placeholder="请填法人名称"/>
          )}
        </Form.Item>
        <Form.Item label="请上传法人身份证正面照片">
          {getFieldDecorator("faren_z",{
            rules:[{required:true,message:'请上传法人身份证正面照片'}]
          })(
            <Upload filemaxlenght={1}
                    onChange={this.onChangefaren_z} uploadtitle="请上传法人身份证正面照片" listtyp="picture-card"/>
          )}
        </Form.Item>
        <Form.Item label="请上传法人身份证反面照片">
          {getFieldDecorator("faren_f",{
            rules:[{required:true,message:'请上传身份证反面照片'}]
          })(
            <Upload  filemaxlenght={1}     onChange={this.onChangefaren_f}   uploadtitle="请上传法人身份证反面照片"  listtyp="picture-card" />
          )}
        </Form.Item>
        <Form.Item {...tailFormItemLayout}>
          <Button type="primary"  className="mb-5" htmlType="submit" >下一步</Button>
        </Form.Item>
      </Form>
    );
  }
}
const RegisterTowgeti = Form.create({name:"register_towgeti"})(TowForm)
export default RegisterTowgeti;
