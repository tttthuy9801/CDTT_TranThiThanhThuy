import { Link } from 'react-router-dom';
export default function Paginate(props) {
    var totalPage = props.totalPage;
    var currentPage = parseInt(props.currentPage);
    var basePath = props.basePath;
    var allli = [];
    if (currentPage !== 1) allli.push(<li><Link to={basePath + 1}>First </Link></li >);
    if (currentPage > 1) allli.push(<li><Link to={basePath + (currentPage - 1)}>Previous</Link></li >);
    for (let i = currentPage - 5; i <= currentPage - 1; i++)
        if (i >= 1) allli.push(<li><Link to={basePath + i}>{i}</Link></li>)
    allli.push(<li><Link style={{ color: 'red' }} to={basePath + currentPage}>{currentPage}</Link></li>)
    for (let i = 1 + currentPage; i <= 5 + currentPage; i++)
        if (i <= totalPage) allli.push(<li><Link to={basePath + i}>{i}</Link></li>)
    if (currentPage < totalPage) allli.push(<li><Link to={basePath + (currentPage + 1)}>Next</Link></li >);
    if (currentPage !== totalPage) allli.push(<li><Link to={basePath + totalPage}>Last</Link></li>);
    return (
        <div className="pagination pagination-centered">
            <ul>
                {allli}
            </ul>
        </div>
    )
}