import React from 'react'
import {Form,Icon,Input,Button} from 'antd'

class ThreeForm extends React.Component {
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
      _that.props.submitFormThree(vlaues)
    })
  }
  checkPassword = (rule,value,callback) =>{
    const {form} =this.props
    if(value && value !== form.getFieldValue('password')){
      callback('两次密码不一致');
    }else{
      callback()
    }
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
      <Form {...formItemLayout} className={this.props.className} onSubmit={this.handleSubmit}>
        <Form.Item  label="请输入密码">
          {getFieldDecorator("password",{
            rules:[
              {required:true,message:"请输入密码"},
              {whitespace:true,message:'不能输入空格'},
              {min:6,message:"最少输入6位数的密码"},
            ]
          })(
            <Input placeholder="请输入密码"  autoComplete="off" type="password"   prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}/>
          )}
        </Form.Item>
        <Form.Item label="确认密码">
          {getFieldDecorator("repassword",{
            rules:[
              {required:true,message:'确认密码'},
              {min:6,message:"最少输入6位数的密码"},
              {whitespace:true,message:'不能输入空格'},
              {validator: this.checkPassword}]
          })(
            <Input  placeholder="确认密码" autoComplete="off"  type="password"
                    prefix={<Icon type="lock"  style={{ color: 'rgba(0,0,0,.25)' }} />}

            />
          )}
        </Form.Item>
        <Form.Item {...tailFormItemLayout}>
          <Button  onClick={this.props.prev} className="mx-5">上一步</Button>
          <Button type="primary"  className="mb-5" htmlType="submit" >完成</Button>
        </Form.Item>
      </Form>
    );
  }
}
const RegisterThree = Form.create({name:"register_tow"})(ThreeForm)
export default RegisterThree;
