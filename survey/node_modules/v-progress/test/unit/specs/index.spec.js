import Vue from 'vue'
import {VLine, VCircle} from 'v-progress'

describe('Circle', () => {
  let vm = null
  beforeEach(() => {
    const Line = Vue.extend(VLine)
    vm = new Line({
      propsData: {
        percent: 30,
        strokeWidth: 1
      }
    }).$mount()
  })

  it('Line works', () => {
    expect(vm.percent).to.equal(30)
  })
})

describe('Circle', () => {
  let Circle = null
  before(() => {
    Circle = Vue.extend(VCircle)
  })

  it('works', () => {
    const vm = new Circle({
      propsData: {
        percent: 30,
        strokeWidth: 1
      }
    }).$mount()

    expect(vm.percent).to.equal(30)
  })

  it('gap degree bottom', () => {
    const vm = new Circle({
      propsData: {
        percent: 30,
        strokeWidth: 1,
        gapDegree: 70,
        gapPosition: 'bottom'
      }
    }).$mount()

    expect(vm.percent).to.equal(30)
  })

  it('gap degree top', () => {
    const vm = new Circle({
      propsData: {
        percent: 30,
        strokeWidth: 1,
        gapDegree: 70,
        gapPosition: 'top'
      }
    }).$mount()

    expect(vm.percent).to.equal(30)
  })

  it('gap degree right', () => {
    const vm = new Circle({
      propsData: {
        percent: 30,
        strokeWidth: 1,
        gapDegree: 70,
        gapPosition: 'right'
      }
    }).$mount()

    expect(vm.percent).to.equal(30)
  })

  it('gap degree left', () => {
    const vm = new Circle({
      propsData: {
        percent: 30,
        strokeWidth: 1,
        gapDegree: 70,
        gapPosition: 'left'
      }
    }).$mount()

    expect(vm.percent).to.equal(30)
  })

  it('self change with animation', () => {
    // const Demo = Vue.extend(Circle)
    const vm = new Circle({
      propsData: {
        percent: 20,
        strokeWidth: 1
      }
    }).$mount()

    expect(vm.percent).to.equal(20)
    vm.percent = 30
    vm.$nextTick = (() => {
      expect(vm.percent).to.equal(30)
    })
  })
})
