// Componente principal da aplicação
const App = () => {
    const [products, setProducts] = React.useState([]);
    const [loading, setLoading] = React.useState(true);

    React.useEffect(() => {
        // Buscar produtos da API do WordPress
        fetch('/wp-json/wp/v2/produto')
            .then(response => response.json())
            .then(data => {
                setProducts(data);
                setLoading(false);
            })
            .catch(error => {
                console.error('Erro ao carregar produtos:', error);
                setLoading(false);
            });
    }, []);

    if (loading) {
        return <div className="loading">Carregando produtos...</div>;
    }

    return (
        <div className="products-container">
            <h1>Nossos Produtos</h1>
            <div className="products-grid">
                {products.map(product => (
                    <ProductCard key={product.id} product={product} />
                ))}
            </div>
        </div>
    );
};

// Componente de card de produto
const ProductCard = ({ product }) => {
    return (
        <div className="product-card">
            {product.featured_media && (
                <img 
                    src={product.featured_media_url} 
                    alt={product.title.rendered}
                    className="product-image"
                />
            )}
            <h2>{product.title.rendered}</h2>
            <div 
                className="product-description"
                dangerouslySetInnerHTML={{ __html: product.excerpt.rendered }}
            />
        </div>
    );
};

// Renderizar a aplicação React
const root = ReactDOM.createRoot(document.getElementById('wp-react-products-root'));
root.render(<App />); 