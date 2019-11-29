import React from 'react'
import {Pagination,Row,Col,Button,message,Checkbox,Form,Menu,Dropdown,Icon,Empty } from 'antd'
import axios from 'axios'
class ReChargeList extends React.Component {
  constructor(props) {
    super(props)
    this.state={
      data:"",
      chencklist:[]
    }
  }
  componentWillMount(){
    this.loadData()
  }
  loadData = (page,key) =>{
    const _that  = this
    axios.post("/user/invest_log/index",{
      user_id_check:_that.props.userInfor.id,
      token_check:_that.props.userInfor.token,
      page:page,
      bill:key
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
  chenckonChange = (checkedValues) => {
    console.log(checkedValues);

    this.setState({chencklist:checkedValues})

  }
  /*onSubmit = (e) =>{
    const _that  = this
    axios.post("/user/bill_log/add/",{
      user_id_check:_that.props.userInfor.id,
      token_check:_that.props.userInfor.token,
      inverst_id:this.state.chencklist.join(",")
    }).then(function (response) {
      if(response.data.res === 1){
        message.success("声请开票成功");
      }else {
        message.error(response.data.err);
      }
    }).catch(function (err) {
      alert(err)
    })
  }*/
  onClick = (e) => {
    const billid = e.target.getAttribute("data_uid")
    const _that  = this
    axios.post("/user/bill_log/add/",{
      user_id_check:_that.props.userInfor.id,
      token_check:_that.props.userInfor.token,
      inverst_id:billid
    }).then(function (response) {
      if(response.data.res === 1){
        message.success("申请开票成功");
        _that.loadData()
      }else {
        message.error(response.data.err);
      }
    }).catch(function (err) {
      alert(err)
    })
  }
  handleMenuClick = (key) => {
    this.loadData(1,key.key)
  }
  render() {
    let list =[];
    console.log(this.state.data.data)
    if(this.state.data){
      console.log()
      list = this.state.data.data.map(value =>
        <div key={value.id} className="p-3">
          <Row>
            <Col span={6}>{value.id}</Col>
            <Col span={6}>{value.price}</Col>
            <Col span={6}>{value.time}</Col>
            <Col span={6} ><span>{value.isbill}</span><Button type="primary" disabled={value.isbill === "已开票"} size="small" onClick={this.onClick} data_uid={value.id} className="y-1   rounded mx-3 px-3">开票</Button></Col>
          </Row>
        </div>
      )
    }
    const menu = (
      <Menu onClick={this.handleMenuClick}>
        <Menu.Item key="0">
          <a  rel="noopener noreferrer" value={0}>未开票</a>
        </Menu.Item>
        <Menu.Item key="1">
          <a  rel="noopener noreferrer"value={0} >已开票</a>
        </Menu.Item>
        <Menu.Item key=" ">
          <a  rel="noopener noreferrer"value={0} >全部</a>
        </Menu.Item>
      </Menu>
    );
    return (
      <div>
        <div className="p-3 bg-secondary">
          <Row>
            <Col span={6}>充值单号</Col>
            <Col span={6}>充值金额</Col>
            <Col span={6}>充值时间</Col>
            <Col span={6}>
              <Dropdown overlay={menu}>
                <a className="ant-dropdown-link d-flex align-items-center"  >
                  是否开票<Icon type="down" className="mx-2" />
                </a>
              </Dropdown>
            </Col>
          </Row>
        </div>
        <Form onSubmit={this.onSubmit}>
          {list}
      {/*    <Checkbox.Group style={{ width: '100%' }} onChange={this.chenckonChange}>
            {list}
          </Checkbox.Group>
          <Form.Item>
            <div className="d-flex justify-content-center">
              {this.state.data.total > 0?<Button type="primary" htmlType="submit">开票</Button>:<Empty/>}
            </div>
          </Form.Item>*/}
        </Form>
        <div className="d-flex justify-content-center my-3">
          <Pagination hideOnSinglePage={true} onChange={this.onChange} defaultCurrent={1}  total={this.state.data.last_page*10}/>
        </div>
      </div>
    );
  }
}

export default ReChargeList;
