import React from 'react';
import {Link} from 'react-router-dom'
import BorderShadowWrap from "../BorderShadowWrap";
import {Row,Col,Button,Pagination,Empty,Icon,message} from 'antd'
import axios from 'axios'
import  ProjectModal from './ProjectModal'
class Project extends React.Component{
  constructor(props){
      super()
      this.state={projectinfo: {},user_id_check:'',token_check:"",projectid:props.match.params.projectid }
  }
  componentDidMount() {
    this.loadData();
  }
  loadData(){
    const _that = this;
    const userid = localStorage.getItem("hyquser_id")
    const usertoken = localStorage.getItem("hyqutoken")
    axios.post("/index/goods/goodsinfo",{
      user_id_check:userid,
      token_check:usertoken,
      id:_that.state.projectid,
    }).then(function(response){
      if(response.data.res === 1){
        _that.setState({projectinfo:response.data.data,user_id_check:userid,token_check:usertoken})
        localStorage.setItem("reId",response.data.data.user_id);
      }else {
        message.error(response.data.err)
      }
    }).catch(function (err) {
      message.error(err)
    })
    axios.post("/user/info/info",{
      user_id_check:userid,
      token_check:usertoken,
    }).then(function (response) {
      _that.setState({userinfo:response.data.data})
    })
    axios.post("/user/goods_order/isadd",{
      user_id_check:userid,
      token_check:usertoken,
      id:_that.state.projectid,
    }).then(function (response) {
        _that.setState({jiedan:response.data.res})
    }).catch(function (err) {
      alert(err)
    })
  }
  render() {
    const  projectinfo = this.state.projectinfo
    const Title=(
      <div className="d-flex align-items-center">
        <span style={{color:"#666666"}}>云企公坊</span>
        <span className="iconfont icon-circle-fill mx-1 fontSize14"></span>
        <span>项目详情</span>
      </div>
    )
    let name = "暂无"
    if(projectinfo.companyinfo != null){
      name = projectinfo.companyinfo.name
    }
    return (
      <div style={{marginBottom:"100px"}}>
        <BorderShadowWrap title={Title}>
          <Row className=" mt-1" >
            <Col span={24}>
              <Link to="/yunqi" className="btn-link d-flex align-items-center mb-2 "><Icon className="mr-1" type="arrow-left" />返回列表</Link>
            </Col>
            <Col span={24}>
              <span className="mr-2">开始时间：{projectinfo.timeb}</span>
              <span className="mr-2">结束时间：{projectinfo.timee}</span>
              <span className="mr-2">申请：{projectinfo.order_sum}</span>
            </Col>
          </Row>
          <Row>
            <Col span={24}>
              <h2 className="d-flex justify-content-between my-4">
                <div>
                  {projectinfo.title}
                </div>
                <div className="text-warning">
                  {parseFloat(projectinfo.price).toFixed(2)} <span className="text-dark fontSize18">元</span>
                </div>
              </h2>
            </Col>
            <Col span={24}>
               {this.state.user_id_check  ? this.state.jiedan == 1 ?  <ProjectModal userinfo={this.state}/>: <Button disabled>已经申请过该项目</Button> :<Button disabled>还没有登录</Button> }
            </Col>

          </Row>
        </BorderShadowWrap>
        <div className="container">
          <Row className="bg-white px-5 py-3 border shadow " style={{marginTop:"-75px"}}>
            <Col span={24}>
              <h6 className="my-3 text-break">
                <p className="small">任务详情</p>
                <span style={{width:"40px",height:'2px',backgroundColor:"#808080"}}></span>
              </h6>
            </Col>
            <p className="my-4 fontSize16 text-dark">任务类型：{projectinfo.titletype}</p>
            <p className="my-4 fontSize16 text-dark">项目金额：{projectinfo.price}</p>
            <p className="my-4 fontSize16 text-dark">结算方式：{projectinfo.pricetype}</p>
            <p className="my-4 fontSize16 text-dark">职位详情：{projectinfo.des}</p>
            <p className="my-4 fontSize16 text-dark">工作时间：{projectinfo.timeb}</p>
            <p className="my-4 fontSize16 text-dark">工作地点：{projectinfo.address}</p>
            <p className="my-4 fontSize16 text-dark">公司名称：{name}</p>
          </Row>
        </div>
      </div>

    );
  }
}
export default Project;
