import React from 'react'
import UserContext from '../context/UserContext'
class UserContextConsumer extends  React.Component{
  render() {
    return (
      <UserContext.Consumer>
         <h1>111</h1>
      </UserContext.Consumer>
    );
  }
}

