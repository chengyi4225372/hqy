import React from 'react'
import {Row,Col} from 'antd'
import { HashRouter as Router,Route,Link} from 'react-router-dom'
import UserOrderList from './UserOrderList'
import UserInfoSliderFace from "./UserInfoSliderFace";
import UserInfoSliderNav from "./UserInfoSliderNav";
import UserEdit from './UserEdit'
import UserEditPwd from './UserEditPwd'
import UserOrderInfo from './UserOrderInfo'
class UserInfo extends React.Component {
  constructor(props) {
    super(props)
  }

  render() {
    const url = this.props.match.url
    return (
      <Router>
          <ul>
            <li>
              <Link to={`${url}/home`}>Home</Link>
            </li>
            <li>
              <Link to={`${url}/about`}>about</Link>
            </li>
          </ul>
          <hr/>
          <Route exact path={`${url}/home`} component={UserOrderList} />
          <Route path={`${url}/about`} component={UserInfoSliderFace} />
      </Router>
    );
  }
}

export default UserInfo;
