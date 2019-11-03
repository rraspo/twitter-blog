import axios from 'axios'
import React, { Component } from 'react'
import ReactDOM from 'react-dom'

class TwitterTimeline extends Component {

    constructor(props) {
        super(props)
        let shownUser = JSON.parse(props.user)
        let autheduser = props.autheduser ? JSON.parse(props.autheduser) : ''
        this.state = {
            autheduser: autheduser,
            user: shownUser,
            tweets: []
        }
    }

    componentDidMount() {
        const self = this
        let user_id = this.state.user.id
        axios.get('/api/tweets/' + user_id)
            .then(function (response) {
                self.setState({
                    tweets: response.data
                })
                self.forceUpdate()
            })
            .catch(function (error) {
            })
    }

    toggleTweet(user_id, tweet) {
        const self = this
        this.setState((prevState) => {
            tweets: prevState.tweets.map((stateTweet) => {
                if (stateTweet.id_str === tweet.id_str) {
                    stateTweet.hidden = !tweet.hidden
                }
            })
        })
        axios.get('/api/tweets/' + user_id + '/toggle/' + tweet.id_str)
            .then((response) => {
                self.forceUpdate()
            })
        self.forceUpdate()
    }

    render() {
        if (this.state.tweets.length > 0) {
            this.tweets = this.state.tweets.map((tweet, key) => {
                if (typeof tweet.message === 'undefined') {
                    if (tweet.hidden && this.state.autheduser != this.state.user.id) {
                        return null
                    }
                    let anchor = "";
                    if (this.state.autheduser == this.state.user.id) {
                        const toggleText = tweet.hidden ? 'hidden' : 'shown'
                        anchor = 
                            <a href="#!" onClick={() => { this.toggleTweet(this.state.autheduser, tweet) }} className={"badge float-right "+(tweet.hidden ? 'badge-danger': 'badge-primary')}>{toggleText}</a>
                    }
                    return (
                        <li className="list-group-item tweet" key={tweet.id || key}>
                            <div className="row align-items-center no-gutters">
                                <div className="col-lg-2 col-md-4">
                                    <img src={tweet.user.profile_image_url_https || ''} alt="User profile picture" className="rounded-circle" width="50" height="50" />
                                </div>
                                <div className="col-lg-9 col-md-6">
                                    <div className="row no-gutters">
                                        <span className="font-weight-bold">
                                            &nbsp; {tweet.user.name}
                                        </span>
                                    </div>
                                    <div className="row no-gutters">
                                        <span className="text-muted">
                                            &nbsp;@{this.state.user.twitter_username}
                                        </span>
                                    </div>
                                </div>
                                <div className="col-lg-1 col-md-2 align-self-start">
                                    {anchor}
                                </div>
                            </div>
                            <div className="row no-gutters">
                                <p className="card-text">
                                    {tweet.text || tweet.message}
                                </p>
                            </div>
                        </li>
                    )
                } else {
                    return (
                        <li className="list-group-item tweet" key={key}>
                            {tweet.message}
                        </li>
                    )
                }
            })
        } else {
            this.tweets =
                <li className="list-group-item tweet">
                    Not found or inaccessible.
                </li>
        }
        return (
            <div className="row justify-content-center">
                <div className="col-md-12">
                    <div className="card twitter-container">
                        <div className="card-header twitter-card">
                            <i className="fab fa-twitter-square"></i>&nbsp;Tweets by @{this.state.user.twitter_username}
                        </div>
                        <ul className="list-group">
                            {this.tweets}
                        </ul>
                    </div>
                </div>
            </div>
        )
    }
}

export default TwitterTimeline

if (document.getElementById('twitter-timeline')) {
    const el = document.getElementById('twitter-timeline')
    const props = Object.assign({}, el.dataset)
    ReactDOM.render(<TwitterTimeline {...props} />, document.getElementById('twitter-timeline'))
}
