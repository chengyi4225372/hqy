import React from 'react'
import {Row,Col,Button} from 'antd'
import CollectionsPage from "./CollectionsPage";
class UserOrderInfo extends  React.Component{
  constructor(props) {
    super(props);
    this.state={
      userdata:"",
    }
  }
  render() {
    const orderInfo = this.props.orderinfo
    let goodsinfo = "";
    if(orderInfo){
      goodsinfo = orderInfo.goodsinfo
    }
    console.log(goodsinfo)
    console.log(orderInfo.state)
    console.log(orderInfo.state === "正常")
    return (
      <div>
        <Row className="px-4 py-3 bg-secondary">
          <Col span={6} className="fontSize14">订单时间:{orderInfo.time} </Col>
          <Col span={6} className="text-right fontSize14">订单状态：{orderInfo.state} </Col>
        </Row>
        <div className="px-4">
          <Row>

            <Col span={24} className="my-3">标题：{goodsinfo.title}
            </Col>
            <Col span={24} className="my-3">任务类型：{goodsinfo.titletype} </Col>
            <Col span={24} className="my-3">价格：{goodsinfo.price}</Col>
            <Col span={24} className="my-3">支付状态:{orderInfo.pay}</Col>
            <Col span={24} className="my-3">结算状态：{goodsinfo.suan}</Col>
            <Col span={24} className="my-3">截至时间：{goodsinfo.timee}</Col>
            <Col span={24} className="my-3">地址：{goodsinfo.address}</Col>
            <Col span={24} className="my-3">详细信息：{goodsinfo.des}</Col>
            <Col span={24} className="my-3">订单ID：{goodsinfo.goodsid}</Col>
            <Col span={24} className="my-3">申请理由：{orderInfo.msg}</Col>
            {orderInfo.state !== "正常"
              ?<Button type="primary" disabled>您已被选中</Button>:<Button disabled>等待选择用工</Button>
             }
          </Row>
          <hr/>
        
          <hr/>
          {orderInfo.state !== "已完结"
            ?<CollectionsPage  state1={orderInfo.state}  orderid={this.props.orderid}/>: null
          }
        </div>


      </div>


    );
  }
}

export  default  UserOrderInfo;
