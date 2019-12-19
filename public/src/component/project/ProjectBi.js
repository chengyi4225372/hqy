import React from 'react';
import {Link} from 'react-router-dom'
import {Row,Col,Button,Input,Icon,Cascader,Form,Radio,TextArea,Select,Option} from 'antd'
import axios from 'axios'
import {options} from "../contract/Option";

const RadioGroup = Radio.Group;
let id = 0;
class Project extends React.Component{
  constructor(props){
      super()
      this.state={projectinfo: {},user_id_check:'',token_check:"",projectid:props.match.params.projectid }
      this.addStu = this.addStu.bind(this)
      this.stuRmove = this.stuRmove.bind(this)
  }

  stuRmove(k){
    const {form} = this.props;
    const stu = form.getFieldValue('stu')
    if(stu.length ===0 ){
      return
    }
    form.setFieldsValue({
      stu:stu.filter(stu => stu !== k)
    })
  }

  addStu(){
   
    const {form}  = this.props
    const stu = form.getFieldValue('stu');
    const netstu= stu.concat(id++)
    form.setFieldsValue({
      stu:netstu
    })
  }

  handleSubmit = (e) =>{
    e.preventDefault();
    const _that = this
    this.props.form.validateFields((err,vlaues)=> {
      if (err) {
        return
      }
      const userid = localStorage.getItem("hyquser_id")
      const usertoken = localStorage.getItem("hyqutoken")
      vlaues.token_check=usertoken
      vlaues.user_id_check=userid
      console.log(vlaues);
     
     // _that.props.submitFormTow(vlaues)
     axios.post("/user/info/geti",{
      token_check:usertoken,
      user_id_check:userid,
      name:vlaues.name,
      zhusuo:vlaues.zhusuo,
      jingying:vlaues.jingying,
      youbian:vlaues.youbian,
      shouji:vlaues.shouji,
      zhiben:vlaues.zhiben,
      leixing:vlaues.leixing,
      hesuan:vlaues.hesuan,
      renshu:vlaues.renshu,
      hangye:vlaues.hangye,
      fangwen:vlaues.fangwen
    }).then(function (resopnse) {
      console.log(resopnse);

   
    }).catch(function (err) {
      alert(err)
    })

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
        xs: { span: 12 },
        sm: { span: 10 },
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

    getFieldDecorator('stu',{initialValue: [] });
    const stu = getFieldValue('stu')
    const stuItem = stu.map((k,index)=>
      <div key={index}>
        <Row>
          <Col span={24}>
            <h6 className="d-flex my-4 justify-content-between">
              <span>教育经历/2</span>
              {stu.length>0? (<span onClick={()=>this.stuRmove(k)} className="text-danger d-flex align-items-center">
               <Icon className="mx-1" type="plus"/>删除教育经历
              </span>):null}
            </h6>

            <span>11111111111111111111111111</span>
          </Col>
        
        </Row>
        {stuItem}
      </div>
         
    )

    return (
      <Form {...formItemLayout} className={this.props.className} onSubmit={this.handleSubmit}>
        <Form.Item  label="名称">
          {getFieldDecorator("name",{
            rules:[
              {required:true,message:"请填写您的名称"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[\u4E00-\u9FA5\uf900-\ufa2d·s]{2,20}$/,message:"名称格式不正确"}
            ]
          })(
            <Input placeholder="请填写您的名称"  />
          )}
        </Form.Item>
        <Form.Item  label="企业住所">
        {getFieldDecorator("zhusuo",{
            rules:[{required:true,message:'请填写企业住所'}]
          })(
            <Cascader style={inputwidth} options={options}  placeholder="请填写企业住所"></Cascader>
          )}

        </Form.Item>
        <Form.Item  label="经营地">
          {getFieldDecorator("jingying",{
            rules:[
              {required:true,message:"请填写经营地"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写经营地"  />
          )}
        </Form.Item>

        <Form.Item  label="邮编">
          {getFieldDecorator("youbian",{
            rules:[
              {required:true,message:"请填写邮编"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写邮编"  />
          )}
        </Form.Item>

        <Form.Item  label="联系电话">
          {getFieldDecorator("shouji",{
            rules:[
              {required:true,message:"请填写联系电话"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写联系电话"  />
          )}
        </Form.Item>

        <Form.Item  label="注册资本(万元)">
          {getFieldDecorator("zhiben",{
            rules:[
              {required:true,message:"请填写注册资本(万元)"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写注册资本(万元)"  />
          )}
        </Form.Item>

        <Form.Item  label="企业类型">
          {getFieldDecorator("leixing",{
            rules:[
              {required:true,message:"请填写企业类型"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写企业类型"  />
          )}
        </Form.Item>

        <Form.Item  label="核算方式">
          {getFieldDecorator("hesuan",{
            rules:[
              {required:true,message:"请填写核算方式"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写核算方式"  />
          )}
        </Form.Item>

        <Form.Item  label="从业人数">
          {getFieldDecorator("renshu",{
            rules:[
              {required:true,message:"请填写从业人数"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写从业人数"  />
          )}
        </Form.Item>

        <Form.Item  label="行业类型">
          {getFieldDecorator("hangye",{
            rules:[
              {required:true,message:"请填写行业类型"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写行业类型"  />
          )}
        </Form.Item>

        <Form.Item  label="经营范围">
          {getFieldDecorator("fanwen",{
            rules:[
              {required:true,message:"请填写经营范围"},
              {whitespace:true,message:'不能包含空字符串'}
             // {pattern:/^[1-9]\d{7}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}$|^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}([0-9]|X)$/,message:'身份证格式不正确'}
            ]
          })(
            <Input placeholder="请填写经营范围"  />
           
          )}
        </Form.Item>
    
        <Row>
          <Col span={24}>
          <h6 className="d-flex my-4 justify-content-between">
            <span>教育经历/1</span>
            <span onClick={this.addStu} className="text-warning d-flex align-items-center">
              <Icon className="mx-1" type="plus"/>添加教育经历
            </span>
          </h6>
          </Col>
          <Col span={24}>
            <Form.Item>
              {getFieldDecorator('stuTime', {
                rules:[{required:true,message:'请选择时间'}]
              })(
                <Input style={inputwidth} />
              )}
            </Form.Item>
          </Col>
        </Row>

        <Form.Item {...tailFormItemLayout}>
          <Button type="primary"  className="mb-5" htmlType="submit" >提交</Button>
        </Form.Item>
      </Form>

    );
  }
}

const Project1 = Form.create({name:"register_tow"})(Project)
export default Project1;
