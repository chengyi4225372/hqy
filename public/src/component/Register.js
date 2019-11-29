import React from 'react';
import {Link} from 'react-router-dom'
import RegisterOne from './RegisterOne'
import RegisterTow from './RegisterTow'
import RegisterTowgeti from './RegisterTowgeti'
import RegisterThree from './RegisterThree'
import { Steps,Form, Input, Tooltip, Icon, Cascader, Select, Row, Col, Checkbox, Button, AutoComplete, Radio } from 'antd';
import axios from 'axios';
import '../css/Register.css'
import ContraclFour from "./contract/ContraclFour";
const Step = Steps.Step;
class Register extends React.Component{
  constructor(){
    super();
    this.state={current:0,user_id_check:'',token_check:""}
  }
  setToken = (values) =>{
    const _that =this
    this.setState({usertype:values.usertype})
    axios.post("/index/api/loginphone",{
      phone:values.phone,
      smscode:values.smscode,
      usertype:values.usertype
    }).then(function (resopnse) {
      console.log(resopnse)
      if(resopnse.data.res === 1 ){
        const user_id = resopnse.data.data.user_id
        const usertoken = resopnse.data.data.token
        _that.next()
        _that.setState({user_id_check:user_id,token_check:usertoken })
      }else{
        alert(resopnse.data.err)
      }
    }).catch(function (err) {
      alert(err)
    })
  }
  next = () =>{
    this.setState(function (prev,next) {
      return {current:prev.current+1}
    })
  }
  prev = () =>{
    this.setState(function (prev,next) {
      return {current:prev.current-1}
    })
  }
  submitFormTow = (data) => {
      this.setState({formTow:data})
      this.next()
  }
  submitFormTowgeti = (data) => {
       this.setState({formTowcompany:data})
        this.next()
  }
  submitFormThree = (data) =>{
      this.next()
      localStorage.setItem("hyquser_id",this.state.user_id_check)
      localStorage.setItem("hyqutoken",this.state.token_check)
      const state = this.state;
      axios.post("/user/info/editpassword",{
        user_id_check:state.user_id_check,
        token_check:state.token_check,
        password:data.password
      }).then(function (response) {
        console.log(response);
        if(response.data.res ==0){
          alert(response.data.err)
        }
      }).catch(function (err) {
        alert(err)
      })
      this.allSubmit()
  }
  allSubmit = () => {
    const _that = this
    const state = this.state;
    if(this.state.usertype == 1){
      axios.post("/user/info/person",{
        user_id_check:state.user_id_check,
        token_check:state.token_check,
        name:state.formTow.name,
        code:state.formTow.code,
        pic:state.formTow.pic[0],
        picf:state.formTow.picf[0],
      })
    }else{
      axios.post("/user/info/company",{
        user_id_check:state.user_id_check,
        token_check:state.token_check,
        name:state.formTowcompany.company,
        type:state.formTowcompany.type,
        pic:state.formTowcompany.pic[0],
        pro:state.formTowcompany.address[0],
        city:state.formTowcompany.address[1],
        addressdtail:state.formTowcompany.addressdtail,
        year:state.formTowcompany.year,
        faren_name: state.formTowcompany.faren_name,
        faren_z: state.formTowcompany.faren_z[0],
        faren_f: state.formTowcompany.faren_f[0],
      })
    }

  }
  render() {
    const current =this.state.current
    let step;
    if(current === 0){
      step = <RegisterOne next={this.next} data={this.state} setToken={this.setToken}  submitFormOne={this.submitFormOne}/>
    }else if(current === 1){
        step = <RegisterTow next={this.next}  submitFormTow={this.submitFormTow}/>
    }else if(current === 2){
          step = <RegisterThree next={this.next}  submitFormThree={this.submitFormThree}/>
    }else if(current === 3){
            step = <ContraclFour/>
    }

    return (
      <div  className=" my-5 container-fluid d-flex align-items-center">
         <div className="container shadow ">
           <div className="d-flex justify-content-center">
             <Steps current={this.state.current} className="mt-5" style={{width:"800px"}}>
               <Step title="验证手机号" description="请验证您的手机号码" />
               <Step title="实名认证" description="认证您的身份信息" />
               <Step title="设置密码" description="请设置您的登录密码" />
               <Step title="完成操作" description="按提示操作" />
             </Steps>
           </div>
             <Row className="d-flex  justify-content-center mt-4">
               <Col span={12}>
                  <RegisterOne
                    className={parseInt(this.state.current) == 0? "d-block":"d-none"}
                    setToken={this.setToken}/>
                 {this.state.usertype == 1 ?
                   <RegisterTow
                     className={parseInt(this.state.current) == 1? "d-block":"d-none"}
                     submitFormTow={this.submitFormTow}/>:""
                  }
                 {
                   this.state.usertype == 2 ? <RegisterTowgeti
                     className={parseInt(this.state.current) == 1? "d-block":"d-none"}
                     submitFormTowgeti={this.submitFormTowgeti}
                   />:''
                 }
                  <RegisterThree className={parseInt(this.state.current) == 2 ? "d-block":"d-none"}
                                 prev={this.prev} submitFormThree={this.submitFormThree}/>
                  <ContraclFour className={parseInt(this.state.current) == 3 ? "d-block":"d-none"} />
               </Col>
             </Row>
         </div>
      </div>
    );
  }
}
export default Register;
