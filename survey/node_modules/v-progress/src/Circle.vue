<template>
  <svg
    :class="[`${prefixCls}-circle`, className]"
    viewBox="0 0 100 100"
    :style="styles"
  >
    <path
      :d="pathString"
      :stroke="trailColor"
      :stroke-width="trailWidth || strokeWidth"
      fill-opacity="0"
      :style="trailPathStyle"
    />
    <path
      :d="pathString"
      :stroke-linecap="strokeLinecap"
      :stroke="strokeColor"
      :stroke-width="percent === 0 ? 0 : strokeWidth"
      fill-opacity="0"
      ref="path"
      :style="strokePathStyle"
    />
  </svg>
</template>

<script>
import mixin from './mixin'

export default {
  mixins: [mixin],
  props: {
    gapDegree: {
      type: Number,
      default: 0
    },
    gapPosition: {
      validator: function(value) {
        return ['top', 'bottom', 'left', 'right'].indexOf(value) !== -1
      },
      default: 'top'
    }
  },
  computed: {
    pathString: function() {
      const radius = 50 - (this.strokeWidth / 2)
      let beginPositionX = 0
      let beginPositionY = -radius
      let endPositionX = 0
      let endPositionY = -2 * radius
      switch (this.gapPosition) {
        case 'left':
          beginPositionX = -radius
          beginPositionY = 0
          endPositionX = 2 * radius
          endPositionY = 0
          break
        case 'right':
          beginPositionX = radius
          beginPositionY = 0
          endPositionX = -2 * radius
          endPositionY = 0
          break
        case 'bottom':
          beginPositionY = radius
          endPositionY = 2 * radius
          break
        default:
      }
      return `M 50,50 m ${beginPositionX},${beginPositionY}
      a ${radius},${radius} 0 1 1 ${endPositionX},${-endPositionY}
      a ${radius},${radius} 0 1 1 ${-endPositionX},${endPositionY}`
    },
    trailPathStyle: function() {
      const radius = 50 - (this.strokeWidth / 2)
      const len = Math.PI * 2 * radius
      return {
        strokeDasharray: `${len - this.gapDegree}px ${len}px`,
        strokeDashoffset: `-${this.gapDegree / 2}px`,
        transition: 'stroke-dashoffset .3s ease 0s, stroke-dasharray .3s ease 0s, stroke .3s'
      }
    },
    strokePathStyle: function() {
      const radius = 50 - (this.strokeWidth / 2)
      const len = Math.PI * 2 * radius
      return {
        strokeDasharray: `${(this.percent / 100) * (len - this.gapDegree)}px ${len}px`,
        strokeDashoffset: `-${this.gapDegree / 2}px`,
        transition: 'stroke-dashoffset .3s ease 0s, stroke-dasharray .3s ease 0s, stroke .3s, stroke-width .06s ease .3s' // eslint-disable-line
      }
    }
  }
}
</script>
