import React, { Component } from 'react'
import { Link } from 'react-router-dom'
import { connect } from 'react-redux'
import { deleteAccount, getAllAccounts } from './redux/actions'

export class Home extends Component {
    handleOnDelete = (id)=>{
        this.props.deleteAccount(id)
    }
    componentDidMount(){
        this.props.getAllAccounts()
    }
    render() {
        return (
            <div>
                <Link to="/add">Add Account</Link>

                <table>
                    <tr>
                        <th>Accout Name</th>
                        <th>Accout Number</th>
                        <th>Bank Name</th>
                        <th>Bank Branch</th>
                        <td>Actions</td>
                    </tr>
                    {this.props.loading && <p>Loading...</p>}
                    {this.props.accounts.map(account=>{
                        return <tr>
                            <td>{account.accountName}</td>
                            <td>{account.accountNumber}</td>
                            <td>{account.bankName}</td>
                            <td>{account.bankBranch}</td>
                            <td><Link to={`/edit/${account.id}`}>Edit Account</Link> | <a onClick={()=>{this.handleOnDelete(account.id)}}>Delete</a></td>
                        </tr>
                    })}
                </table>
            </div>
        )
    }
}

const mapStateToProps = (state)=>{
    console.log(state)
    return state
}


export default connect(mapStateToProps, {deleteAccount, getAllAccounts})(Home)
