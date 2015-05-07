<?php

namespace SS6\ShopBundle\Model\Product\TopProduct;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query\Expr\Join;
use SS6\ShopBundle\Component\Debug;
use SS6\ShopBundle\Model\Product\Product;
use SS6\ShopBundle\Model\Product\ProductRepository;
use SS6\ShopBundle\Model\Product\TopProduct\TopProduct;

class TopProductRepository {

	/**
	 * @var \Doctrine\ORM\EntityRepository
	 */
	private $em;

	/**
	 * @var \SS6\ShopBundle\Model\Product\ProductRepository
	 */
	private $productRepository;

	/**
	 * @param \Doctrine\ORM\EntityManager $entityManager
	 */
	public function __construct(EntityManager $entityManager, ProductRepository $productRepository) {
		$this->em = $entityManager;
		$this->productRepository = $productRepository;
	}

	/**
	 * @return \Doctrine\ORM\EntityRepository
	 */
	private function getTopProductRepository() {
		return $this->em->getRepository(TopProduct::class);
	}

	/**
	 * @param int $id
	 * @return \SS6\ShopBundle\Model\Product\TopProduct\TopProduct|null
	 */
	public function getById($id) {
		return $this->getOneByCriteria(['id' => $id]);
	}

	/**
	 * @param \SS6\ShopBundle\Model\Product\Product $product
	 * @param int $domainId
	 * @return \SS6\ShopBundle\Model\Product\TopProduct\TopProduct|null
	 */
	public function getByProductAndDomainId(Product $product, $domainId) {
		return $this->getOneByCriteria(['product' => $product, 'domainId' => $domainId]);
	}

	/**
	 * @param int $domainId
	 * @return \SS6\ShopBundle\Model\Product\TopProduct\TopProduct[]
	 */
	public function getAll($domainId) {
		return $this->getTopProductRepository()->findBy(['domainId' => $domainId]);
	}

	/**
	 * @param array $criteria
	 * @return \SS6\ShopBundle\Model\Product\TopProduct\TopProduct|null
	 */
	private function getOneByCriteria(array $criteria) {
		$result = $this->getTopProductRepository()->findOneBy($criteria);
		if ($result === null) {
			$message = 'Top product not found by criteria ' . Debug::export($criteria);
			throw new \SS6\ShopBundle\Model\Product\TopProduct\Exception\TopProductNotFoundException($message);
		}
		return $result;
	}

	/**
	 * @param int $domainId
	 * @param \SS6\ShopBundle\Model\Pricing\Group\PricingGroup $pricigGroup
	 * @return \SS6\ShopBundle\Model\Product\Product[]
	 */
	public function getVisibleProductsForTopProductsOnDomain($domainId, $pricigGroup) {
		$queryBuilder = $this->productRepository->getAllListableQueryBuilder($domainId, $pricigGroup);

		$queryBuilder
			->join(TopProduct::class, 'tp', Join::WITH, 'tp.product = p')
			->andwhere('tp.domainId = :domainId')
			->andwhere('tp.domainId = prv.domainId')
			->setParameter('domainId', $domainId);

		return $queryBuilder->getQuery()->execute();
	}
}
