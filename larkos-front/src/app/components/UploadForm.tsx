import React, { useState, ChangeEvent, FormEvent } from 'react';
import Button from 'react-bootstrap/Button';
import Form from 'react-bootstrap/Form';
import { useRef } from 'react';
import { IMaskInput } from 'react-imask';

interface FormData {
	name: string;
	email: string;
	phone: string;
	avatar: File | null;
}

interface Errors {
	errors: Error
}

interface Error {
	name: string,
	email: string,
	phone: string,
	avatar: any,
}

const UploadForm: React.FC = () => {
	const [formData, setFormData] = useState<FormData>({
		name: '',
		email: '',
		phone: '',
		avatar: null,
	});

	const [error, setError] = useState<Errors | null>(null)

	const handleChange = (e: ChangeEvent<HTMLInputElement>) => {
		const { name, value, files } = e.target;
		setFormData((prevFormData) => ({
			...prevFormData,
			[name]: files ? files[0] : value,
		}));
	};

	const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
		e.preventDefault();
		const data = new FormData();
		data.append('name', formData.name);
		data.append('email', formData.email);
		data.append('phone', formData.phone);
		if (formData.avatar) {
			data.append('avatar', formData.avatar);
		}

		try {
			const response = await fetch('http://localhost:8000/api/upload', {
				method: 'POST',
				body: data,
				headers: {
					'X-Requested-With': 'XMLHttpRequest',
				},
			});
			
			if (response.status == 422) {
				const err = await response.json();
			setError(err)
			} else {
				setError(null)
			}
		} catch (error) {

		}
	};

	const ref = useRef(null);
	const inputRef = useRef(null);
	
	return (
		<div className="upload-form red">
			<Form onSubmit={handleSubmit} encType="multipart/form-data">
				<Form.Group className="mb-3" >
					<Form.Label className='input-label'>Name</Form.Label>
					
					<Form.Control name="name" type="text" value={formData.name} onChange={handleChange} placeholder="Enter Name" />
					<Form.Text className="text-warning">
						{error?.errors?.name}
					</Form.Text>
				</Form.Group>
				<Form.Group className="mb-3" >
					<Form.Label className='input-label'>Email</Form.Label>
					<Form.Control name="email" type="email" value={formData.email} onChange={handleChange} placeholder="Enter Email" />
					<Form.Text className="text-warning">
						{error?.errors?.email}
					</Form.Text>
				</Form.Group>
				<Form.Group className="mb-3" >
					<Form.Label className='input-label'>Phone</Form.Label>
					<IMaskInput className='form-control'
						mask={'+{7}(000)000-00-00'}
						unmask={true}
						ref={ref}
						inputRef={inputRef}
						placeholder='Enter phone number here'
						name="phone"
						value={formData.phone}
						onChange={handleChange}
					/>
					<Form.Text className="text-warning">
						{error?.errors?.phone}
					</Form.Text>
				</Form.Group>

				<Form.Group className="mb-3" >
					<Form.Label className='input-label'>File</Form.Label>
					<Form.Control name="avatar" type="file" onChange={handleChange} />
					<Form.Text className="text-warning">
						{error?.errors?.avatar}
					</Form.Text>
				</Form.Group>
				<Button variant="primary" type="submit">
					Upload
				</Button>

			</Form>
		</div>
	);
};

export default UploadForm;