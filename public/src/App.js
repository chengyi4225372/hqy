import React,{Suspense} from "react";
import { HashRouter as Router,Route,} from "react-router-dom";
import {Spin} from 'antd'
import Header from './component/Header';
import Foot from './component/Foot';
import IndexContent from  './component/IndexContent'
import './css/App.css';
import UserContext from './context/UserContext'
import TestUserContext from './context/TestUserContext'
const UserOrderInfo = React.lazy(() => import('./component/userSelfinfo/UserOrderInfo'))
const PassWorldLogin = React.lazy(() => import('./component/PassWorldLogin'))
const RqLogin = React.lazy(() => import('./component/RqLogin'))
const SmsLogin = React.lazy(() => import('./component/SmsLogin'))
const FaBuRenWu = React.lazy(() => import('./component/userInfo/FaBuRenWu'))
const Register = React.lazy(() => import('./component/Register'))
const UserSelfInfo = React.lazy(() => import('./component/userSelfinfo/UserSelfInfo'))
const Contract = React.lazy(() => import('./component/contract/Contract'))
const Project = React.lazy(() => import('./component/project/Project'))
const UserInfo = React.lazy(() => import('./component/userInfo/UserInfo'))
const Guanyu = React.lazy(() => import('./page/Guanyu'))
const Xiaoguo = React.lazy(() => import('./page/Xiaoguo'))
const Jiejue = React.lazy(() => import('./page/Jiejue'))
const Yunqi = React.lazy(() => import('./page/Yunqi'))
const Yunduan = React.lazy(() => import('./page/Yunduan'))
const Qiye = React.lazy(() => import('./page/Qiye'))
const ProjectZR = React.lazy(() => import('./component/project/ProjectBi'))
class App extends React.Component{
  constructor(props) {
    super(props);
    this.state={userinfo:{id:1,name:"罗雨祥"}}
  }
  render(){
    return (
      <UserContext.Provider value={this.state}>
        <Router >
          <Header />
          <Suspense  fallback={<div>
            <Spin size="large" />
            <Spin size="large" />
            <Spin size="large" />
          </div>}>
            <Route exact path="/" component={IndexContent} />
            <Route path="/pwdlogin" component={PassWorldLogin} />
            <Route path="/smslogin" component={SmsLogin} />
            <Route path="/rqlogin" component={RqLogin} />
            <Route path="/register" component={Register} />
            <Route path="/qiye" component={Qiye} />
            <Route path="/yunduan" component={Yunduan} />
            <Route path="/yunqi" component={Yunqi} />
            <Route path="/jiejue" component={Jiejue} />
            <Route path="/xiaoguo" component={Xiaoguo} />
            <Route path="/guanyu" component={Guanyu} />
            <Route path="/userinfo" component={UserInfo}/>
            <Route path="/userself" component={UserSelfInfo}/>
            <Route path="/project/:projectid" component={Project}/>
            <Route path="/contract" component={Contract}/>
            <Route path="/faburenwu" component={FaBuRenWu}/>
            <Route path="/order" component={UserOrderInfo}/>
            <Route path="/t" component={TestUserContext}/>
            <Route path="/p" component={ProjectZR}/>
          </Suspense>
          <Foot />
        </Router>
      </UserContext.Provider>
    );
  }
}

export default App;
