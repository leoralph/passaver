const RowSubmit = (props) => {
    return (
        <div className="row justify-content-center mt-3">
            <div className="col d-grid">
                <button type="submit" className="btn btn-primary">{props.children}</button>
            </div>
        </div>
    )
}
export default RowSubmit