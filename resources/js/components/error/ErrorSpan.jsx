const ErrorSpan = (props) => {
    return (
        <span className={`text-danger ${props.className ?? ''}`.trim()}>{props.error}</span>
    )
}
export default ErrorSpan