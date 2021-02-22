import { connect } from 'react-redux';
import { compose, getContext } from 'recompose';
import PropTypes from 'prop-types';

export default (...args) => compose(
  getContext({ id: PropTypes.string }),
  connect(...args),
);
