<template>
  <svg
    :class="[`${prefixCls}-circle`, className]"
    :viewBox="viewBoxString"
    preserve-aspect-ratio="none"
    :style="styles"
  >
    <path
      :d="pathString"
      :stroke-linecap="strokeLinecap"
      :stroke="trailColor"
      :stroke-width="trailWidth || strokeWidth"
      fill-opacity="0"
    />
    <path
      :d="pathString"
      :stroke-linecap="strokeLinecap"
      :stroke="strokeColor"
      :stroke-width="strokeWidth"
      fill-opacity="0"
      ref="path"
      :style="pathStyle"
    />
  </svg>
</template>

<script>
import mixin from './mixin'

export default {
  mixins: [mixin],
  computed: {
    pathStyle: function() {
      return {
        strokeDasharray: '100px, 100px',
        strokeDashoffset: `${(100 - this.percent)}px`,
        transition: 'stroke-dashoffset 0.3s ease 0s, stroke 0.3s linear'
      }
    },
    pathString: function() {
      const center = this.strokeWidth / 2
      const right = 100 - (this.strokeWidth / 2)
      return `M ${this.strokeLinecap === 'round' ? center : 0},${center}
              L ${this.strokeLinecap === 'round' ? right : 100},${center}`
    },
    viewBoxString: function() {
      return `0 0 100 ${this.strokeWidth}`
    }
  }
}
</script>
