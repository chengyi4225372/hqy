import React from 'react'
import {Pagination,Row,Col,Button,message,Checkbox,Form,Icon,Empty} from 'antd'
import axios from 'axios'
class InvoiceList extends React.Component {
  constructor(props) {
    super(props)
    this.state={
      data:"",
    }
  }
  componentWillMount(){
    this.loadData()
  }
  loadData = (page) =>{
    const _that  = this
    axios.post("/user/bill_log/index/",{
      user_id_check:_that.props.userInfor.id,
      token_check:_that.props.userInfor.token,
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

  render() {
    let list =[];
    if(this.state.data){
      console.log()
      list = this.state.data.data.map(value =>
        <div key={value.id} className="p-3">
          <Row>
            <Col span={4}>{value.uid}</Col>
            <Col span={4}>{value.price}</Col>
            <Col span={6}>{value.apptime}</Col>
            <Col span={6}>{value.opentime}</Col>
            <Col span={4} ><span>{value.isbill}</span></Col>
          </Row>
        </div>
      )
    }
    return (
      <div>
        <div className="p-3 bg-secondary">
          <Row>
            <Col span={4}>用户</Col>
            <Col span={4}>面额</Col>
            <Col span={6}>申请开票时间</Col>
            <Col span={6}>开票时间</Col>
            <Col span={4}>状态 </Col>
          </Row>
        </div>
        {list.length > 0 ? list:<Empty/>}
        <div className="d-flex justify-content-center my-3">
          <Pagination hideOnSinglePage={true}  onChange={this.onChange} defaultCurrent={1}  total={this.state.data.last_page*10}/>
        </div>
      </div>
    );
  }
}

export default InvoiceList;
