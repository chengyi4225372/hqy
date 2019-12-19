import React from 'react'
import {Pagination,Row,Col,Button,message,Checkbox} from 'antd'
import axios from 'axios'
class Demo extends React.Component {
  constructor(props) {
    super(props)
    this.state={
      data:""
    }
  }
  componentWillMount(){
    this.loadData()
  }
  loadData = (page) =>{
    const _that  = this
    axios.post("/user/invest_log/index/",{
      user_id_check:_that.props.userInfor.id,
      token_check:_that.props.userInfor.token,
      page:page
    }).then(function (response) {
      console.log(response)
      _that.setState({data:response.data.data})
    }).catch(function (err) {
      alert(err)
    })
  }
  onChange = (page) =>{
    this.loadData(page)
  }
  onClick = (e) =>{
    const _that  = this
    const id=e.target.getAttribute("data_id")
    axios.post("/user/bill_log/add",{
      user_id_check:_that.props.userInfor.id,
      token_check:_that.props.userInfor.token,
      id:id
    }).then(function (response) {
      if(response.data.res === 1 ){
        message.success("开票成功")
      }else {
        message.error(response.data.err)
      }
    }).catch(function (err) {
      alert(err)
    })
  }
  checkonChange = (e)=>{

  }
  render() {
    let list =[];
    if(this.state.data){
      console.log()
      list = this.state.data.data.map(value =>
        <div key={value.id} className="p-3">
          <Row>
            <Col span={6}>{value.uid}</Col>
            <Col span={6}>{value.price}</Col>
            <Col span={6}>{value.time}</Col>
            <Col span={6} ><span  >{value.isbill}<span className="btn-warning text-white p-1 mx-2 rounded" onClick={this.onClick} data_id={value.id}>开票</span></span></Col>
          </Row>
        </div>
      )
    }

    return (
      <div>
        <div className="p-3 bg-secondary">
          <Row>
            <Col span={6}>充值单号</Col>
            <Col span={6}>充值金额</Col>
            <Col span={6}>充值时间</Col>
            <Col span={6}>状态</Col>
          </Row>
        </div>
        {list}
        <Checkbox onChange={this.checkonChange} value={1}>Checkbox</Checkbox>
        <div className="d-flex justify-content-center my-3">
          <Pagination onChange={this.onChange} defaultCurrent={1}  total={this.state.data.last_page*10}/>
        </div>
      </div>
    );
  }
}

export default Demo;
