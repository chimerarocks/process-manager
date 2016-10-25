/**
 * Created by joaopedrodslv@gmail.com on 24/07/2016.
 */

import {EventEmitter} from 'events'
import Webpage from 'webpage'
import click from '../lib/click'

export default class Page extends EventEmitter {
    constructor() {
        super()
        this.page = Webpage.create()
        this.buildEmitter()
        this.loadListeners()
        this.click = click
        this.resourceCount = 0
    }

    buildEmitter() {
        this.emitIt = this.emit
        this.emit = (event, data) => {
            this.emitIt(event, {page: this, data:data})
        }
    }

    loadListeners() {
        this.page.onLoadFinished = (status) => {
            this.emit('loadFinished', status)
        }
        this.page.onLoadStarted = () => {
            this.emit('loadStarted')
        }
        this.page.onAlert = (msg) => {
            this.page.emit('alert', msg)
        }
    }

    debug() {
        this.page.onConsoleMessage = (message) => { console.log('console: ' + message)}
        this.page.onError = (error) => { 
            let rect = this.page.clipRect
            this.page.clipRect = { top: 0, left: 0, width: 1200, height: 1200 }
            this.page.render("error" + Math.floor((Math.random() * 1000) + 1) * + ".jpg")
            this.page.clipRect = rect
            console.log('error: ' + error)
        }
    }

    noConsole() {
        this.page.onConsoleMessage = function(){};
        this.page.onError = function(){};
    }

    includeJs(url, callback) {
        return this.page.includeJs(url, callback)
    }

    open(url, callback) {
        this.page.open(url, callback)
    }

    stop() {
        this.page.stop()
    }

    render(path) {
        this.page.render(path)
    }

    clipRect(size) {
        this.page.clipRect = size
    }

    content() {
        return this.page.content
    }

    loadFinishEmits(event) {
        this.page.onLoadFinished = (status) => {
            this.emit(event, status)
        }
    }

    evaluate(func, array) {
        if (undefined === array)
            return this.page.evaluate(func)
        else
            return this.page.evaluate(func, ...array)
    }

    evaluateAsync(func, delay, array) {
        if (undefined === array)
            return this.page.evaluateAsync(func, delay)
        else
            return this.page.evaluateAsync(func, delay, ...array)
    }

    eventsTransport(object) {
        this.emit = (event, data) => {
            this.emitIt(event, {page: this, data:data, transport: object})
        }
    }

    setCallback(event) {
        this.page.onCallback = (data) => {
            this.emit(event, data)
        }
    }

    waitForResourceWithUrlLike(url, emitId, count) {
        this.page.onResourceReceived = (resource) => {
            if (resource.url.indexOf(url) != -1) {
                if (count == ++this.resourceCount) {
                    this.emit(emitId + 'ResourceReceived')
                }
            }
        }
    }
}