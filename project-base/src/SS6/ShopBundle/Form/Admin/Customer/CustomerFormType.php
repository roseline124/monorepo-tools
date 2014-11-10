<?php

namespace SS6\ShopBundle\Form\Admin\Customer;

use SS6\ShopBundle\Model\Customer\CustomerData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CustomerFormType extends AbstractType {

	const SCENARIO_CREATE = 'create';
	const SCENARIO_EDIT = 'edit';

	/**
	 * @var string
	 */
	private $scenario;

	/**
	 * @var \SS6\ShopBundle\Model\Domain\Config\DomainConfig[]
	 */
	private $domains;

	/**
	 * @var \SS6\ShopBundle\Model\Domain\SelectedDomain
	 */
	private $selectedDomain;

	/**
	 * @var \SS6\ShopBundle\Model\Pricing\Group\PricingGroup[]
	 */
	private $pricingGroups;

	/**
	 * @param string $scenario
	 * @param \SS6\ShopBundle\Model\Domain\Config\DomainConfig[]|null $domains
	 * @param \SS6\ShopBundle\Model\Domain\SelectedDomain $selectedDomain
	 * @param \SS6\ShopBundle\Model\Pricing\Group\PricingGroup[]|null $pricingGroups
	 */
	public function __construct($scenario, $domains = null, $selectedDomain = null, $pricingGroups = null) {
		$this->scenario = $scenario;
		$this->domains = $domains;
		$this->selectedDomain = $selectedDomain;
		$this->pricingGroups = $pricingGroups;
	}

	/**
	 * @return string
	 */
	public function getName() {
		return 'customer';
	}

	/**
	 * @param \Symfony\Component\Form\FormBuilderInterface $builder
	 * @param array $options
	 */
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('userData', new UserFormType($this->scenario, $this->domains, $this->selectedDomain, $this->pricingGroups))
			->add('billingAddressData', new BillingAddressFormType())
			->add('deliveryAddressData', new DeliveryAddressFormType())
			->add('save', 'submit');

		if ($this->scenario === self::SCENARIO_CREATE) {
			$builder->add('sendRegistrationMail', 'checkbox', array('required' => false));
		}
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => CustomerData::class,
			'attr' => array('novalidate' => 'novalidate'),
		));
	}

}
