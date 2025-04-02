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
    // Extrair preço do conteúdo do produto (assumindo que está em um campo personalizado)
    const price = product.meta?.price || 'R$ 0,00';
    
    return (
        <div className="product-card">
            {product.featured_media && (
                <img 
                    src={product.featured_media_url} 
                    alt={product.title.rendered}
                    className="product-image"
                />
            )}
            <div className="product-price">{price}</div>
            <h2>{product.title.rendered}</h2>
            <div 
                className="product-description"
                dangerouslySetInnerHTML={{ __html: product.excerpt.rendered }}
            />
            <div className="product-actions">
                <button className="btn-primary">Ver Detalhes</button>
                <button className="btn-secondary">Adicionar ao Carrinho</button>
            </div>
        </div>
    );
};

// Renderizar a aplicação React
const root = ReactDOM.createRoot(document.getElementById('wp-react-products-root'));
root.render(<App />); 