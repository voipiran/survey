var mixin = {
  props: {
    className: {
      type: [String, Object],
      default: ''
    },
    percent: {
      type: [Number, String],
      default: 0
    },
    prefixCls: {
      type: String,
      default: 'vue-progress'
    },
    styles: {
      type: Object
    },
    strokeColor: {
      type: String,
      default: '#2db7f5'
    },
    strokeLinecap: {
      type: String,
      default: 'round',
      validator: function(value) {
        return ['butt', 'round', 'square'].indexOf(value) !== -1
      }
    },
    strokeWidth: {
      type: [String, Number],
      default: 1
    },
    trailWidth: {
      type: [String, Number],
      default: 1
    },
    trailColor: {
      type: String,
      default: '#D9D9D9'
    }
  },
  updated() {
    if (!this.$refs.path) {
      return
    }
    const pathStyle = this.$refs.path.style
    pathStyle.transitionDuration = '.3s, .3s, .3s, .06s'
    const now = Date.now()
    if (this.prevTimeStamp && now - this.prevTimeStamp < 100) {
      pathStyle.transitionDuration = '0s, 0s'
    }
    this.prevTimeStamp = Date.now()
  }
}
export default mixin
