import React from 'react';
import {Steps,Row,Col} from 'antd'
import axios from 'axios'
import BorderShadowWrap from "../BorderShadowWrap";
import ContractOne from "./ContractOne";
import ContracTow from "./ContracTow";
import ContractThree from "./ContractThree";
import ContraclFour from "./ContraclFour";
const Step = Steps.Step;
class Contract extends  React.Component{
  constructor(props){
    super(props)
    this.state={current:0}
    this.next = this.next.bind(this)
    this.submitFormOne = this.submitFormOne.bind(this)
    this.submitFormTow = this.submitFormTow.bind(this)
    this.submitFormThree = this.submitFormThree.bind(this)
    this.prev = this.prev.bind(this);
  }
  componentDidMount(){
    const user_id_check = localStorage.getItem("hyquser_id")
    const token_check = localStorage.getItem("hyqutoken")
    this.setState({user_id_check:user_id_check,token_check:token_check})
    const _that = this;
    axios.post("/user/info/info",{
      user_id_check:user_id_check,
      token_check:token_check
    }).then(function (reopsonse) {
      if(reopsonse.data.res === 1){
        _that.setState({userInfo:reopsonse.data.data})
      }
    }).catch(function (err) {
      alert(err);
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
  submitFormOne(data){
    this.setState({formOne:data})
    this.next();
  }
  submitFormTow(data){
    this.setState({formTow:data})
    this.next();
  }
  submitFormThree(data){
    this.setState({formThree:data})
    const _that = this
    axios.post("/user/user_person_job/all",{
      user_id_check:_that.state.user_id_check,
      token_check:_that.state.token_check,
      skill:_that.state.formTow.work
    }).then(function (response) {
      console.log(response)
    }).catch(function (err) {
      alert(err)
    })
    axios.post("/user/user_person_edu/all",{
      user_id_check:_that.state.user_id_check,
      token_check:_that.state.token_check,
      skill:_that.state.formTow.stu
    }).then(function (response) {
      console.log(response)
    }).catch(function (err) {
      alert(err)
    })
    axios.post("/user/info/person",{
      user_id_check:_that.state.user_id_check,
      token_check:_that.state.token_check,
      name:_that.state.userInfo.name,
      code:_that.state.userInfo.code,
      pic :_that.state.userInfo.pic,
      picf :_that.state.userInfo.picf ,
      jtype:_that.state.formOne.workDay.join(','),
      job:_that.state.formTow.pationFangxiang,
      jobname:_that.state.formTow.pationJob,
      jtime:[_that.state.formOne.workTime[0],_that.state.formOne.workTime[1]].join(','),
      timelong:_that.state.formOne.weekWorkTime,
      jobarea:_that.state.formOne.workScope,
      jobaddress:_that.state.formOne.address.join(","),
      money:_that.state.formOne.price,
      fileone:_that.state.formTow.file.join(","),
      filetow:_that.state.formThree.file.join(","),
    }).then(function (resopnse) {
      console.log(resopnse);
    }).catch(function (err) {
      alert(err)
    })
    axios.post("/user/user_person_ji/all",{
      user_id_check:_that.state.user_id_check,
      token_check:_that.state.token_check,
      skill:_that.state.formThree.skill
    }).then(function (response) {
      console.log(response)
    }).catch(function (err) {
      alert(err)
    })
    axios.post("/user/user_person_job/all",{
      user_id_check:_that.state.user_id_check,
      token_check:_that.state.token_check,
      skill:_that.state.formThree.project
    }).then(function (response) {
      console.log(response)
      _that.next()
    }).catch(function (err) {
      alert(err)
    })

  }
  render() {
    const current =this.state.current
    const Title = "申请签约订单"
    return (
      <BorderShadowWrap title={Title}>
        <Row className="d-flex justify-content-center">
          <Col span={20} >
            <Steps size="samll" current={current}>
              <Step title="填写工作信息"  />
              <Step title="完善个人履历"/>
              <Step title="添加技能和作品" />
              <Step title="申请成功"/>
            </Steps>
            <ContractOne className={parseInt(current) === 0 ? "d-block":"d-none"}  submitformone={this.submitFormOne}/>
            <ContracTow className={parseInt(current) === 1 ? "d-block":"d-none"}  prev={this.prev} submitformtow={this.submitFormTow}/>
            <ContractThree className={parseInt(current) === 2 ? "d-block":"d-none"}  prev={this.prev} submitformthree={this.submitFormThree}/>
            <ContraclFour prev={this.prev} className={parseInt(current) === 3 ? "d-block":"d-none"}  />
          </Col>
        </Row>
      </BorderShadowWrap>
    );
  }
}

export default Contract;
