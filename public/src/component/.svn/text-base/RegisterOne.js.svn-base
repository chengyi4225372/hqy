import React from 'react'
import axios from 'axios'
import {Form,Input,button,Col,Row,Icon,Button,Radio} from 'antd'
const RadioGroup = Radio.Group;

class OneForm extends React.Component{
  constructor(props) {
    super(props);
    this.state = {
      getsmscode:true,
      tiemout:0,
    };
    this.getCode = this.getCode.bind(this)
  }
  tick() {
    if(this.state.tiemout === 0){
      clearInterval(this.interval);
    }else {
      this.setState(prevState =>({
        tiemout:prevState.tiemout-1
      }))
    }
  }
  handleChange = (event) => {
    this.setState({phone: event.target.value});
    const reg = /^[1][0-9]{10}$/
    if(!reg.test(event.target.value)){
      this.setState({getsmscode:true})
    }else{
      this.setState({getsmscode:false})
    }

  }
  getCode(event){
    this.setState({tiemout:60})
    const _that = this;
    this.interval = setInterval(() => this.tick(), 1000);
    axios.post('/index/api/sms', {
      phone: _that.state.phone,
    })
      .then(function (response) {
        if (response.data.res == 0){
          alert(response.data.err)
        }
      })
      .catch(function (error) {
        console.log(error);
      });
  }
  handleSubmit = (e) =>{
    e.preventDefault();
    const _that = this
    this.props.form.validateFields((err,vlaues)=> {
      if (err) {
        return
      }
      console.log(vlaues)
      _that.props.setToken(vlaues)
    })
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
        <Form.Item  label="请填写手机号码">
              {getFieldDecorator("phone",{
                rules:[
                  {required:true,message:"请填写手机号码"},
                  {pattern:/^1[0-9]{10}$/,message:"手机号格式错误"}
                ]
              })(
                <Input  placeholder="请输入手机号码"
                        onChange={this.handleChange}
                        prefix={<Icon type="user" style={{ color: 'rgba(0,0,0,.25)' }} />}/>
              )}
        </Form.Item>
        <Form.Item label="请填写验证码">
          <Row>
            <Col span={18}>
              {getFieldDecorator("smscode",{
                rules:[{required:true,message:'请输入验证码'}]
              })(
                <Input   placeholder="请输入验证码"

                         prefix={<Icon type="lock" style={{ color: 'rgba(0,0,0,.25)' }} />}
                />
              )}
            </Col>
            <Col span={6}>
              <Button type="primary"   style={{borderRadius:"0 4px 4px 0 "}}
                    onClick={this.getCode}
                    disabled={this.state.getsmscode || this.state.tiemout}
              >{this.state.tiemout ? "重新发送"+this.state.tiemout :"获取验证码"}</Button>
            </Col>
          </Row>

        </Form.Item>
        <Form.Item label="请选择用户类型">
          {getFieldDecorator("usertype",{
            rules:[{required:true,message:'请选择用户类型'}]
          })(
            <RadioGroup>
            <Radio value={1}>个人用户</Radio>
            <Radio value={2}>企业用户</Radio>
            </RadioGroup>
            )
          }
        </Form.Item>

        <Form.Item {...tailFormItemLayout}>
          <Button type="primary"  className="mb-5" htmlType="submit" >下一步</Button>
        </Form.Item>
      </Form>
    );
  }
}
const RegisterOne = Form.create({name:"register_one"})(OneForm)

export  default RegisterOne;


