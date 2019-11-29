import React from 'react'
import { HashRouter as Router,Route,Link} from 'react-router-dom'
import UserEdit from "./UserEdit";
import UserEditPwd from "./UserEditPwd";
import UserOrderInfo from "./UserOrderInfo"
class UserOrderList extends React.Component {
  constructor(props) {
    super(props)
  }

  render() {
    const url =  this.props.match.url
    return (
      <Router>
        <div>
          <ul>
            <li>
              <Link to={`${url}/vav1`}>用户编辑</Link>
            </li>
            <li>
              <Link to={`${url}/vav2`}>修改密码</Link>
            </li>
            <li>
              <Link to={`${url}/vav3`}>详情</Link>
            </li>
          </ul>
            <Route  path={`${url}/vav1`} component={UserEdit}></Route>
            <Route  path={`${url}/vav2`} component={UserEditPwd}></Route>
            <Route  path={`${url}/vav3`} component={UserOrderInfo}></Route>
          </div>
      </Router>
    );
  }
}

export default UserOrderList;
